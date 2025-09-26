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

        // ✅ Get selected tags from GET
        $selectedTags = isset($_GET['tags']) ? $_GET['tags'] : [];

        // ✅ Fetch filtered carts
        $cartHistory = $this->cartModel->getCartHistoryByUser($userId, $selectedTags);

        $data = [
            'title'        => 'Cart History',
            'activeMenu'   => 'cart',
            'carts'        => $cartHistory,
            'selectedTags' => $selectedTags
        ];

        $this->view('cart/index', $data, 'main');
        // print_r($cartHistory);
    }


}
