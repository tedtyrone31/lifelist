<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model {

    // Register a new user
    public function register($username, $name, $email, $password) {
        // Escape inputs to prevent basic SQL issues
        $name = $this->db->escape($username);
        $name = $this->db->escape($name);
        $email = $this->db->escape($email);

        // Hash the password securely
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username,name, email, password) 
                VALUES ('$username', '$name', '$email', '$passwordHash')";

        if ($this->db->conn->query($sql)) {
            return $this->db->conn->insert_id; // Return new user ID
        }

        return false; // Registration failed
    }

    // Verify login credentials
    public function verifyCredentials($username, $password) {
        $username = $this->db->escape($username);

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->db->conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                return $user; // Successful login
            }
        }
        return false; // Invalid credentials
    }

    // Optional: check if email already exists
    public function emailExists($email) {
        $email = $this->db->escape($email);

        $sql = "SELECT id FROM users WHERE email='$email'";
        $result = $this->db->conn->query($sql);

        return $result && $result->num_rows > 0;
    }

    // Optional: check if username already exists
    public function usernameExists($username) {
        $username = $this->db->escape($username);

        $sql = "SELECT id FROM users WHERE username='$username'";
        $result = $this->db->conn->query($sql);

        return $result && $result->num_rows > 0;
    }
}
