<?php
require_once __DIR__ . '/../core/Database.php';

class Controller {
    protected function view($view, $data = [], $layout = null) {
        extract($data);

        // Render view content
        ob_start();
        require "../app/views/$view.php";
        $content = ob_get_clean();

  
        // Determine which layout to use
        if ($layout && file_exists("../app/views/layouts/$layout.php")) {
            require "../app/views/layouts/$layout.php"; // use the specified layout
        } else {
            echo $content; // no layout, just output the view
        }
    }

    // Load a model
    public function model($model) {
        require_once __DIR__ . "/../models/$model.php";
        return new $model();
    }
    
    // Check if user is logged in
    protected function requireLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            // Redirect to login page if not logged in
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }

        $timeout = 1800; // 30 minutes

        // Check if last_activity exists
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
            // Session expired\
            $_SESSION = [];
            session_unset();
            session_destroy();

            echo "Session expired! Redirecting to login...";

            header('Refresh: 2; URL=' . BASE_URL . 'auth'); // redirect after 2 seconds
            exit;
        } 

        // Update last activity time
        $_SESSION['last_activity'] = time();

    }
}
