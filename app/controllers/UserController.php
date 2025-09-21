<?php
class UserController extends Controller{
    // default method
    public function index() {
        // optional: data to send to view
        $data = [
            'title' => 'User Page'
        ];

        // load the view: views/auth/index.php
        $this->view('user/profile', $data ,'main');
    }

    // public function show($id) {
    //     echo "Showing Todo with ID: " . $id;
    // }
}
