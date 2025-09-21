<?php
require_once __DIR__ . '/Database.php'; // load centralized DB

class Model {
    protected $db;      // Database object
    protected $conn;    // mysqli connection for convenience

    public function __construct() {
        $this->db = new Database();  // Database object
        $this->conn = $this->db->conn; // raw mysqli connection
    }

    // Optional helper to escape input safely
    protected function escape($value) {
        return $this->conn->real_escape_string($value);
    }
}
