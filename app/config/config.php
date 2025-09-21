<?php
// start session
if (session_status() === PHP_SESSION_NONE) session_start();

// DB settings - update to your environment
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Ginger080721!');
define('DB_NAME', 'lifelists_db');

// If you keep index.php in public as front controller:
// When building form action URLs you can use BASE_URL . 'auth/login' etc.
// Example: define('BASE_URL', '/lifelists/public/index.php?url=');
define('BASE_URL', '/lifelists/public/index.php?url=');

