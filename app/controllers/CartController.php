<?php
class CartController extends Controller{

 protected $cartModel;

     public function __construct() {
        // Check if user is logged in before any method
        $this->requireLogin();
        $this->cartModel = $this->model('Cart');
    }

    // default method
   public function index() {
    $userId = $_SESSION['user_id'];
    $selectedTags = isset($_GET['tags']) ? $_GET['tags'] : [];

    $cartHistory = $this->cartModel->getCartHistoryByUser($userId, $selectedTags);

    // ✅ Add a flash message if filters are applied
        if (!empty($selectedTags)) {
            $labels = [];
            $tags = [
                "default"     => "Default", 
                "groceries"   => "Groceries",
                "split"       => "Split", 
                "household"   => "Household", 
                "clothing"    => "Clothing",
                "electronics" => "Electronics",
                "wellness"    => "Personal Care",
                "gifts"       => "Gifts & Events",
                "tools"       => "Tools & Misc",
                "pets"        => "Pets",
            ];

            foreach ($selectedTags as $tag) {
                if (isset($tags[$tag])) {
                    $labels[] = $tags[$tag];
                }
            }

             $_SESSION['filterMessage'] = "Filtering by: " . implode(', ', $labels);
            } elseif (!empty($cartHistory)) {
                // Only show default message if there is cart history
                $_SESSION['filterMessage'] = "Displaying the last 10 completed carts";
            } else {
                // $cartHistory is empty and no filters applied → no message
                unset($_SESSION['filterMessage']);
            }
        $data = [
            'title'        => 'Cart History',
            'activeMenu'   => 'cart',
            'bodyId'   => 'cart',
            'carts'        => $cartHistory,
            'selectedTags' => $selectedTags
        ];

        $this->view('cart/index', $data, 'main');
    }

}
