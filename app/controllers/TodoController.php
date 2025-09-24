<?php
class TodoController extends Controller{

 protected $todoModel;

     public function __construct() {
        // Check if user is logged in before any method
        $this->requireLogin();
        $this->todoModel = $this->model('Todo');
    }

  // default method
  public function index($todo_id = null, $completeStatus = null) {
    $userId = $_SESSION['user_id'];

    // Get selected tags from GET
    $selectedTags = isset($_GET['tags']) ? $_GET['tags'] : [];

    // Fetch todos
    $todosPending   = Todo::getAllTodoByUserAndStatus($userId, Todo::STATUS_PENDING, $selectedTags);
    $todosCompleted = Todo::getAllTodoByUserAndStatus($userId, Todo::STATUS_COMPLETED);

     // Fetch counts
        $pendingCount   = Todo::countTodosByStatus($userId, Todo::STATUS_PENDING, $selectedTags);
        $completedCount = Todo::countTodosByStatus($userId, Todo::STATUS_COMPLETED);

    // Get a specific todo if requested
    $specificTodo = $todo_id ? Todo::find($todo_id) : null;

    // Complete status flag
    $completeStatus = $completeStatus ? true : false;

    $data = [
        'title'            => 'To-Do',
        'activeMenu'       => 'todo',
        'todosPending'     => $todosPending,
        'todosCompleted'   => $todosCompleted,
        'specificTodo'     => $specificTodo,
        'completeStatus'   => $completeStatus,
        'selectedTags'     => $selectedTags,
        'pendingCount'     => $pendingCount,
        'completedCount'     => $completedCount,
    ];

    $this->view('todo/index', $data, 'main');
}


   // Add a new todo
    public function addTodo($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todoTitle = trim($_POST['todo_title'] ?? '');

            if ($todoTitle === '') {
                // Trap empty input
                $_SESSION['errorEmptyMessage'] = "Task title cannot be empty.";
            } else {
                $todo = new Todo();
                $todo->userId    = $id;
                $todo->todoTitle = $todoTitle;
                $todo->tag       = $_POST['tag'] ?? 'default';

                $todoId = $todo->save();

                if ($todoId === false) {
                    $_SESSION['errorMessage'] = "Failed to save todo.";
                } else {
                    $_SESSION['insertTodoMessage'] = "New To-do added successfully!";
                }
            }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "todo/index");
        exit;
    }

    // Update todo info
    public function updateTodo($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todoTitle = trim($_POST['todo_title'] ?? '');
          

            if ($todoTitle === '') {
                // Trap empty input
                $_SESSION['errorEmptyMessage'] = "Task title cannot be empty.";
            } else {
                $todo = new Todo();
                $todo->userId    = $_SESSION['user_id'];
                $todo->todoTitle = $todoTitle;
                $todo->tag       = $_POST['tag'] ?? 'default';
                $todo->todoDescription = trim($_POST['todo_description'] ?? '');
                $todo->dueDate = ($_POST['due_date'] ?? '') !== '' ? trim($_POST['due_date']) : date('Y-m-d');
                $todo->dueTime = ($_POST['due_time'] ?? '') !== '' ? trim($_POST['due_time']) : "00:00";
                $todo->alarmStatus = trim($_POST['alarm_status'] ?? '');
                $todo->alarmSound = trim($_POST['alarm_sound'] ?? '');

                $todoId = $todo->updateTodo($id,$todo->userId);

                if ($todoId === false) {
                    $_SESSION['errorMessage'] = "Failed to save todo.";
                } else {
                    $_SESSION['insertTodoMessage'] = "To-do Info updated successfully!";
                }
            }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "todo/index");
        exit;
    }

     //  update todo status
    public function updateTodoStatus($todoId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
        $todo = new Todo();
        $userId = $todo->userId = $_SESSION['user_id'];
        $todoStatus = $todo->toggleTodoStatus($todoId,$userId);
                if ($todoStatus === false) {
                    $_SESSION['errorMessage'] = "Failed to update todo status.";
                } else {
                    $_SESSION['updateTodoStatusMessage'] = "Todo marked as {$todoStatus}!";
                }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "todo/index");
        exit;
    }


     // delete todo
    public function deleteTodo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $todoId = trim($_POST['todo_id'] ?? '');

            $deleted = Todo::deleteById($todoId, $_SESSION['user_id']);

           if ($deleted) {
                $_SESSION['deleteMessage'] = "Todo deleted successfully.";
            } else {
                $_SESSION['errorMessage'] = "Failed to delete todo.";
            }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "todo/index");
        exit;
    }

}
