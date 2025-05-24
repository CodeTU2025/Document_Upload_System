<?php
require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function register($username, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Users (username, password) VALUES (?, ?)";
        $params = [$username, $passwordHash];
        return sqlsrv_query($this->conn, $sql, $params);
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM Users WHERE username = ?";
        $stmt = sqlsrv_query($this->conn, $sql, [$username]);

        if ($stmt && ($user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                return $user['role'];
            }
        }
        return false;
    }
}
