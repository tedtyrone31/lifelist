<?php
class TobuyController extends Controller{

     public function __construct() {
        // Check if user is logged in before any method
        $this->requireLogin();
    }

     public function index() {
        // optional: data to send to view
        $data = [
            'title' => 'To-Buy',
            'activeMenu' => 'tobuy',
        ];

        // load the view: views/auth/index.php
        $this->view('tobuy/index', $data ,'main');
    }

    public function show($id) {
        echo "Showing Item with ID: " . $id;
    }
}
