<?php 

class DashboardController extends Controller {

     public function __construct() {
        // Check if user is logged in before any method
        $this->requireLogin();
    }

    public function index() {
        // Usually you check if the user is logged in first
        // $this->requireLogin();

        $data = [
            'title' => 'Dashboard',
            'activeMenu' => 'dashboard',
        ];
        
        $this->view('dashboard/index', $data, 'main');
    }

    // private function requireLogin() {
    //     if (!isset($_SESSION['user_id'])) {
    //         header('Location: /auth');
    //         exit;
    //     }
    // }
}
