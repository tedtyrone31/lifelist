<?php
require_once __DIR__ . '/../config/config.php';

class Database {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }
}
