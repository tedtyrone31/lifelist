<?php 
require_once __DIR__ . '/../core/Model.php';

// Cart.php (model)
class Cart extends Model {

    public function addItemToCart($tobuyId, $userId) {
        $db = $this->db->conn;
        $tobuyId = (int)$tobuyId;
        $userId  = (int)$userId;

        // Step 1: get item details from tobuy
        $sql = "SELECT * FROM tobuy 
                WHERE tobuy_id = {$tobuyId} AND user_id = {$userId} 
                LIMIT 1";
        $result = $db->query($sql);
        $item = $result ? $result->fetch_assoc() : null;

        if (!$item) return false;

        // Step 2: find or create today's cart
        $today = date('Y-m-d');
        // $today = "2025-10-6";
        $sql = "SELECT cart_id FROM tobuy_carts 
                WHERE user_id = {$userId} 
                  AND DATE(cart_date) = '{$today}' 
                LIMIT 1";
        $cartResult = $db->query($sql);

        if ($cartResult && $cartResult->num_rows > 0) {
            $cartRow = $cartResult->fetch_assoc();
            $cartId = $cartRow['cart_id'];
        } else {
            $db->query("INSERT INTO tobuy_carts (user_id, cart_date) 
                        VALUES ({$userId}, '{$today}')");
            $cartId = $db->insert_id;
        }

       // Step 3: insert or update into completed_cart_items
        $itemName        = $db->real_escape_string($item['tobuy_item']);
        $tag             = $db->real_escape_string($item['tag']);
        $itemDescription = $db->real_escape_string($item['tobuy_description']);
        $quantity        = (int)$item['quantity'];
        $price           = (float)$item['price'];
        $total           = isset($item['total']) ? (float)$item['total'] : 0;

        $sql = "INSERT INTO tobuy_completed_cart_items 
                    (cart_id, tobuy_id, item_name, tag, item_description, quantity, price, total, completed_at) 
                VALUES 
                    ({$cartId}, {$item['tobuy_id']}, '{$itemName}', '{$tag}', '{$itemDescription}', {$quantity}, {$price}, {$total}, '{$today}')
                ON DUPLICATE KEY UPDATE
                    item_name       = VALUES(item_name),
                    tag             = VALUES(tag),
                    item_description= VALUES(item_description),
                    quantity        = VALUES(quantity),
                    price           = VALUES(price),
                    total           = VALUES(total),
                    completed_at    = '{$today}'";

        $success = $db->query($sql);
        if ($success) {
            // Step 4: update the cart total = SUM of all items in this cart
            $updateTotalSql = "UPDATE tobuy_carts c
                               SET c.total = (
                                   SELECT COALESCE(SUM(total),0)
                                   FROM tobuy_completed_cart_items i
                                   WHERE i.cart_id = c.cart_id
                               )
                               WHERE c.cart_id = {$cartId}";
            $db->query($updateTotalSql);
        }

        return $success;

        }

    // ✅ Get all carts and their items for a user (with recalculated totals)
    public function getCartHistoryByUser($userId, $selectedTags = []) {
        $whereTags = "";

        if (!empty($selectedTags)) {
            $tagsList = "'" . implode("','", array_map('addslashes', $selectedTags)) . "'";
            $whereTags = " AND cci.tag IN ($tagsList)";
        }

        $sql = "SELECT cci.*, c.cart_id, c.user_id, c.cart_date
                FROM tobuy_completed_cart_items cci
                JOIN tobuy_carts c ON cci.cart_id = c.cart_id
                WHERE c.user_id = {$userId}
                {$whereTags}
                ORDER BY c.cart_date DESC, cci.item_id ASC LIMIT 10";

        $result = $this->db->conn->query($sql);

        $carts = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cartId = $row['cart_id'];

                if (!isset($carts[$cartId])) {
                    $carts[$cartId] = [
                        'cart_id'    => $cartId,
                        'cart_date'  => $row['cart_date'],
                        'cart_total' => 0, // ✅ start at 0, recalc below
                        'items'      => []
                    ];
                }

                // Add item
                $carts[$cartId]['items'][] = [
                    'item_name'    => $row['item_name'],
                    'description'  => $row['item_description'],
                    'quantity'     => $row['quantity'],
                    'price'        => $row['price'],
                    'total'        => $row['total'],
                    'tag'          => $row['tag']
                ];

                // ✅ Recalculate total based on filtered items
                $carts[$cartId]['cart_total'] += $row['total'];
            }
        }

        return $carts;
    }


}