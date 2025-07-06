<?php
require_once 'config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function signup($username, $email, $password) {
        // Check if user already exists
        if ($this->userExists($username, $email)) {
            return ['success' => false, 'message' => 'Username or Email already exists'];
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$username, $email, $hashed_password])) {
            return ['success' => true, 'message' => 'User registered successfully'];
        }

        return ['success' => false, 'message' => 'Registration failed'];
    }

    public function login($login, $password) {
        // Check if login is email or username
        $query = "SELECT id, username, email, password FROM " . $this->table_name . " WHERE email = ? OR username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$login, $login]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $user['password'])) {
                return [
                    'success' => true,
                    'user' => [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email']
                    ]
                ];
            }
        }

        return ['success' => false, 'message' => 'Incorrect username/email or password'];
    }

    private function userExists($username, $email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username, $email]);
        
        return $stmt->rowCount() > 0;
    }

    public function getUserById($id) {
        $query = "SELECT id, username, email FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>