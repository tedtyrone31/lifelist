<?php
class AuthController extends Controller {

 protected $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    // Show login/register form and handle POST
    public function index() {
        // Redirect logged-in users to dashboard
        if (!empty($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }

        $formType = $_POST['form_type'] ?? '';
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // if (isset($_POST['register'])) {
            if ($formType === 'register') {
                // --- REGISTER ---
                $username = trim($_POST['username']);
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $password = $_POST['password'];
                $confirm = $_POST['confirm_password'];

                // Validation
                if (empty($name) || empty($email) || empty($password)) {
                    $errors[] = "All fields are required.";
                }

                if ($password !== $confirm) {
                    $errors[] = "Passwords do not match.";
                }

                // Check database for existing email
                if ($this->userModel->emailExists($email)) {
                    $errors[] = "Email already exists.";
                }

                // Check database for existing username
                if ($this->userModel->usernameExists($username)) {
                    $errors[] = "Username already exists.";
                }

                if (empty($errors)) {
                    $userId = $this->userModel->register($username, $name, $email, $password);
                    if ($userId) {

                         // Set a flash message
                        $_SESSION['success_message'] = "Registration successful!You can now log in!";
                        header('Location: ' . BASE_URL . 'auth');
                        exit;
                    } else {
                        $errors[] = "Registration failed. Please contact Administrator.";
                    }
                }

            // } elseif (isset($_POST['login'])) {
            } elseif ($formType === 'login') {
                // --- LOGIN ---
                $username = trim($_POST['username']);
                $password = $_POST['password'];

                if (empty($username) || empty($password)) {
                    $errors[] = "Username and password are required.";
                }

                if (empty($errors)) {
                    $user = $this->userModel->verifyCredentials($username, $password);
                    if ($user) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_name'] = $user['name'];

                        header('Location: ' . BASE_URL . 'dashboard');
                        exit;
                    } else {
                        $errors[] = "Invalid email or password.";
                    }
                }
            }
        }

        // Pass data to view
        $data = [
            'title' => 'Login / Register',
            'errors' => $errors
            // 'username' => isset($username) ? $username : '',
            // 'email' => isset($email) ? $email : ''
        ];

        $this->view('auth/index', $data, 'auth');
    }

    // Logout user
    public function logout() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Clear all session data
        $_SESSION = [];
        session_unset();
        session_destroy();

        // Redirect to login page
        header('Location: ' . BASE_URL . 'auth');
        exit;
    }
}

