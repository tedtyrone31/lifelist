<?php
class TodoController extends Controller{

 protected $userModel;

     public function __construct() {
        // Check if user is logged in before any method
        $this->userModel = $this->model('Todo');
        $this->requireLogin();
    }

    // default method
    public function index() {
        $todos = Todo::getAllByUser($_SESSION['user_id']); // or $id from session
        
        // optional: data to send to view
        $data = [
            'title'      => 'To-Do',
            'activeMenu' => 'todo',
            'todos'      => $todos
        ];

        $this->view('todo/index', $data, 'main');
    }

   // Add a new todo
    public function addTodo($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todo = new Todo();
            $todo->userId = $id;
            $todo->todoTitle   = trim($_POST['todo_title']);
            $todo->tag     = $_POST['tag'] ?? 'default';


            $todoId = $todo->save();
            
            if ($todoId === false) {
                $_SESSION['errorEmptyMessage'] = "Failed to save todo.";
            } else {
                $_SESSION['insertTodoMessage'] = "New To-do added successfully!";
            }
        }

        // Redirect to index so updated list shows
        header("Location: " . BASE_URL . "todo/index");
        exit;
    }

}
