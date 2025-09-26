<?php
class TobuyController extends Controller{

   protected $tobuyModel;
   protected $cartModel;

     public function __construct() {
        // Check if user is logged in before any method
        $this->requireLogin();
        $this->tobuyModel = $this->model('Tobuy');
        $this->cartModel = $this->model('Cart');
    }

    // default method
    public function index($tobuy_id = null, $completeStatus = null) {
        $userId = $_SESSION['user_id'];

        // Get selected tags from GET
          $selectedTags = isset($_GET['tags']) ? $_GET['tags'] : [];

        // Fetch todos
        $itemPending   = Tobuy::getAllTobuyByUserAndStatus($userId, Tobuy::STATUS_PENDING, $selectedTags);
        $itemCompleted = Tobuy::getAllTobuyByUserAndStatus($userId, Tobuy::STATUS_COMPLETED);

        // // Fetch counts
        $pendingCount   = Tobuy::countTobuyByStatus($userId, Tobuy::STATUS_PENDING, $selectedTags);
        $completedCount = Tobuy::countTobuyByStatus($userId, Tobuy::STATUS_COMPLETED);

        // Get a specific todo if requested
        $specificItem = $tobuy_id ? Tobuy::find($tobuy_id) : null;

        // Complete status flag
        $completeStatus = $completeStatus ? true : false;

        $data = [
            'title'            => 'To-Buy',
            'activeMenu'       => 'tobuy',
            'itemPending'     => $itemPending,
            'itemCompleted'   => $itemCompleted,
            'specificItem'     => $specificItem,
            'completeStatus'   => $completeStatus,
            'selectedTags'     => $selectedTags,
            'pendingCount'     => $pendingCount,
            'completedCount'     => $completedCount,
        ];

        $this->view('tobuy/index', $data, 'main');
        // print_r($specificItem);
    }

    // Add a new todo
    public function addNewItem($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tobuyItem = trim($_POST['tobuy_item'] ?? '');

            if ($tobuyItem === '') {
                // Trap empty input
                $_SESSION['errorEmptyMessage'] = "Item cannot be empty.";
            } else {
                $tobuy = new Tobuy();
                $tobuy->userId    = $id;
                $tobuy->tobuyItem = $tobuyItem;
                $tobuy->tag       = $_POST['tag'] ?? 'default';

                $tobuyId = $tobuy->save();

                if ($tobuyId === false) {
                    $_SESSION['errorMessage'] = "Failed to save todo.";
                } else {
                    $_SESSION['insertTobuyMessage'] = "New item added successfully!";
                }
            }
        }
        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "tobuy/index");
        exit;
    }

     // Update tobuy info
    public function updateTobuy($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tobuyItem = trim($_POST['tobuy_item'] ?? '');

          

            if ($tobuyItem === '') {
                // Trap empty input
                $_SESSION['errorEmptyMessage'] = "Item name cannot be empty.";
            } 
            else {
                $tobuy = new Tobuy();
                $tobuy->userId    = $_SESSION['user_id'];
                $tobuy->tobuyItem = $tobuyItem;
                $tobuy->tag       = $_POST['tag'] ?? 'default';
                $tobuy->tobuyDescription = trim($_POST['tobuy_description'] ?? '');
               // In your Controller (before calling model update)
                $tobuy->unit       = $_POST['unit'] ?? 'pcs';
                $tobuy->quantity = is_numeric($_POST['quantity']) ? $_POST['quantity'] : 0.00;
                $tobuy->price    = is_numeric($_POST['price'])    ? $_POST['price']    : 0.00;
                $tobuy->total    = is_numeric($_POST['total'])    ? $_POST['total']    : 0.00;

                $tobuyId = $tobuy->updateTobuy($id,$tobuy->userId);

                if ($tobuy === false) {
                    $_SESSION['errorMessage'] = "Failed to save tobuy.";
                } else {
                    $_SESSION['insertTodoMessage'] = "To-buy Info updated successfully!";
                }
            }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "tobuy/index");
        exit;
    }

     //  update tobuy status
    public function updateTobuyStatus($tobuyId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
        $tobuy = new Tobuy();
        $userId = $_SESSION['user_id'];

        $tobuyStatus = $tobuy->toggleTobuyStatus($tobuyId,$userId);

        if ($tobuyStatus === 'completed') {
            // ✅ Move item into today's cart
            $cart = new Cart();
            $cart->addItemToCart($tobuyId, $userId);
        }

                if ($tobuyStatus === false) {
                    $_SESSION['errorMessage'] = "Failed to update tobuy item status.";
                } else {
                    $_SESSION['updateTodoStatusMessage'] = "Tobuy item marked as {$tobuyStatus}!";
                }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "tobuy/index");
        exit;
    }

      public function markAsDeleted($tobuyId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
        $tobuy = new Tobuy();
        $userId = $tobuy->userId = $_SESSION['user_id'];
        $deletedStatus = $tobuy->markAsDeleted($tobuyId,$userId);
                if ($deletedStatus === false) {
                    $_SESSION['errorMessage'] = "Failed to update tobuy item status.";
                } else {
                    $_SESSION['updateTodoStatusMessage'] = "Tobuy item marked as deleted!";
                }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "tobuy/index");
        exit;
    }


     // delete item
    public function deleteItem($tobuyId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $deleted = Tobuy::deleteById($tobuyId, $_SESSION['user_id']);

           if ($deleted) {
                $_SESSION['deleteMessage'] = "Tobuy item deleted successfully.";
            } else {
                $_SESSION['errorMessage'] = "Failed to delete item.";
            }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "tobuy/index");
        exit;
    }

    public function tobuyCarts() {
        
    }

}
