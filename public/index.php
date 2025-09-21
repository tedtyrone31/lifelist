
<?php
// public/index.php - Front controller

// Show errors in development (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// load app config (session_start is inside config.php)
require_once __DIR__ . '/../app/config/config.php';

require_once __DIR__ . '/../app/views/partials/sessionalModal.php';


// optionally load composer autoloader if you use composer packages
// require_once __DIR__ . '/../vendor/autoload.php';

// load core classes (App should handle routing & dispatch)
require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

// instantiate the router / application
$app = new App();


