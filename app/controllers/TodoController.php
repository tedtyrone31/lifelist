<?php
class TodoController extends Controller{

     public function __construct() {
        // Check if user is logged in before any method
        $this->requireLogin();
    }

    // default method
    public function index() {
        // optional: data to send to view
        $data = [
            'title' => 'To-Do',
            'activeMenu' => 'todo', 
        ];

        // load the view: views/auth/index.php
        $this->view('todo/index', $data ,'main');
    }

    public function show($id) {
        echo "Showing Todo with ID: " . $id;
    }
}
