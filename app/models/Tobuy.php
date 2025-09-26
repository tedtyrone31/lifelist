<?php 
require_once __DIR__ . '/../core/Model.php';

class Tobuy extends Model {
    public $tobuyId;
    public $userId;
    public $tobuyItem;
    public $tag;
    public $status;
    public $created_at;
    public $tobuyStatus;
    public $updated_at;
    public $tobuyDescription;
    public $quantity;
    public $unit;
    public $price;
    public $total;

    const STATUS_PENDING   = 'pending';
    const STATUS_COMPLETED = 'completed';

    // Save new item on object state
    public function save() {

        $tobuyItem = $this->db->conn->real_escape_string($this->tobuyItem);
        $tag   = $this->db->conn->real_escape_string($this->tag);

        $sql = "INSERT INTO tobuy (user_id, tobuy_item, tag, created_at) 
                  VALUES ('{$this->userId}', '{$tobuyItem}', '{$tag}', NOW())";

        if ($this->db->conn->query($sql)) {
            $this->tobuyId = $this->db->conn->insert_id; // return todo ID
            return $this;
        }
        return false; // failed
    }

    // Static finder method: get all tobuy
    public static function getAllTobuyByUserAndStatus($userId, $status, $tags=[]) {
        $db = (new self())->db->conn; 
        $userId = (int) $userId;
        $status = $db->real_escape_string($status);


        $sql = "SELECT * FROM tobuy WHERE user_id = {$userId} AND status = '{$status}'";

        // Apply tag filter if selected
        if (!empty($tags)) {
            $tagList = implode("','", array_map([$db, 'real_escape_string'], $tags));
            $sql .= " AND tag IN ('{$tagList}')";
        }

        $sql .= " ORDER BY updated_at DESC";

        $result = $db->query($sql);
        $tobuys = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tobuy = new self();
                $tobuy->tobuyId   = $row['tobuy_id'];
                $tobuy->userId   = $row['user_id'];
                $tobuy->tobuyItem = $row['tobuy_item'];
                $tobuy->tag       = $row['tag'];
                $tobuy->status    = $row['status'];
                $tobuy->created_at = $row['created_at'];
                $tobuys[] = $tobuy;
            }
        }

        return $tobuys;
    }

    // Static finder method
    public static function find($tobuy_id) {
        $db = (new self())->db->conn; // create instance just to access db

        $tobuy_id = (int) $tobuy_id; // sanitize

        $sql = "SELECT * FROM tobuy WHERE tobuy_id = {$tobuy_id} ORDER BY created_at DESC LIMIT 1";
        $result = $db->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $tobuy = new self();
            $tobuy->tobuyId    = $row['tobuy_id'];
            $tobuy->userId    = $row['user_id'];
            $tobuy->tobuyItem   = $row['tobuy_item'];
            $tobuy->tag         = $row['tag'];
            $tobuy->status      = $row['status'];
            $tobuy->created_at  = $row['created_at'];
            $tobuy->updated_at  = $row['updated_at'];
            $tobuy->tobuyDescription  = $row['tobuy_description'];
            $tobuy->quantity  = $row['quantity'];
            $tobuy->price  = $row['price'];
            $tobuy->total  = $row['total'];
            return $tobuy;
        }
        return null; // not found
    }

    // UPDATE TODO INFO
    public function updateTobuy($tobuyId,$userId) {
        $tobuyItem     = $this->db->conn->real_escape_string($this->tobuyItem);
        $tag           = $this->db->conn->real_escape_string($this->tag);
        $tobuyDescription   = $this->db->conn->real_escape_string($this->tobuyDescription);
        $quantity   = $this->db->conn->real_escape_string($this->quantity);
        $unit   = $this->db->conn->real_escape_string($this->unit);
        $price   = $this->db->conn->real_escape_string($this->price);
        $total   = $this->db->conn->real_escape_string($this->total);
 
        $sql = "UPDATE tobuy 
                SET tobuy_item = '{$tobuyItem}', 
                    tag = '{$tag}', 
                    tobuy_description = '{$tobuyDescription}',
                    quantity = $quantity,
                    unit = '{$unit}',
                    price = $price,
                    total = $total
                WHERE tobuy_id = '{$tobuyId}' 
                AND user_id = '{$userId}' 
                LIMIT 1";

        if ($this->db->conn->query($sql)) {
            return true; // success
        }
        return false; // failed
    }

    // UPDATE tobuy item status
    public function toggleTobuyStatus($tobuyId, $userId) {
    // Sanitize to integers
    $tobuyId = (int) $tobuyId;
    $userId  = (int) $userId;

    // Get current status
    $sql = "SELECT status, completed_at 
            FROM tobuy 
            WHERE tobuy_id = {$tobuyId} 
              AND user_id = {$userId} 
            LIMIT 1";

    $result = $this->db->conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        // Determine new status
        $newStatus = ($row['status'] === 'completed') ? 'pending' : 'completed';

        // Handle completed_at logic (only set once)
        $completedAtSql = "";
        if ($newStatus === 'completed' && empty($row['completed_at'])) {
            $completedAtSql = ", completed_at = NOW()";
        }

        // Build safe update query
        $updateSql = "UPDATE tobuy 
                      SET status = '{$newStatus}', 
                          updated_at = NOW(){$completedAtSql}
                      WHERE tobuy_id = {$tobuyId} 
                        AND user_id = {$userId}
                      LIMIT 1";

        // Debug (optional)
        // echo $updateSql; exit;

        if ($this->db->conn->query($updateSql)) {
            return $newStatus; // ✅ return new status instead of boolean
        }
    }

    return false; // failed
}



     // UPDATE tobuy item status
    public function markAsDeleted($tobuyId, $userId) {
        // Get current status
        $sql = "SELECT status FROM tobuy 
                WHERE tobuy_id = '{$tobuyId}' 
                AND user_id = '{$userId}' 
                LIMIT 1";
        $result = $this->db->conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $updateSql = "UPDATE tobuy 
                        SET status = 'deleted', 
                            updated_at = NOW()
                        WHERE tobuy_id = '{$tobuyId}' 
                            AND user_id = '{$this->userId}' 
                        LIMIT 1";

            if ($this->db->conn->query($updateSql)) {
                return $updateSql; // ✅ return new status instead of boolean
            }
        }

        return false; // failed
    }


     // Count todos by status, optionally filtered by tags
    public static function countTobuyByStatus($userId, $status, $tags = []) {
        $db = (new self())->db->conn;
        $userId = (int)$userId;
        $status = $db->real_escape_string($status);

        $sql = "SELECT COUNT(*) AS total FROM tobuy WHERE user_id = {$userId} AND status = '{$status}'";

        if (!empty($tags)) {
            $tagList = implode("','", array_map([$db, 'real_escape_string'], $tags));
            $sql .= " AND tag IN ('{$tagList}')";
        }

        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        return (int)$row['total'];
    }



    // Static method: delete tobuy item by ID
    public static function deleteById($tobuyId, $user_id) {
        $db = (new self())->db->conn;

        // It's safer to include user_id in the WHERE clause 
        // so a user cannot delete someone else's todo
        $sql = "DELETE FROM tobuy WHERE tobuy_id = {$tobuyId} AND user_id = {$user_id} LIMIT 1";

        $result = $db->query($sql);

        return $result ? true : false; // return boolean
    }
}