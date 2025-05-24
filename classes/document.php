<?php
// classes/Document.php
require_once 'Database.php';

class Document {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function upload($user_id, $file, $category) {
        $fileName = basename($file['name']);

        // Directories
        $uploadDir = "../CodeTu/upload/" . $category . "/";
        $downloadDir = "../CodeTu/download/" . $category . "/";
        $uploadPath = $uploadDir . $fileName;
        $downloadPath = $downloadDir . $fileName;

        // Create folders if not exist
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        if (!is_dir($downloadDir)) mkdir($downloadDir, 0777, true);

        // Upload and copy
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            copy($uploadPath, $downloadPath);

            $sql = "INSERT INTO Documents (user_id, filename, category) VALUES (?, ?, ?)";
            return sqlsrv_query($this->conn, $sql, [$user_id, $fileName, $category]);
        }

        return false;
    }

    public function getAllDocuments() {
        $sql = "SELECT d.*, u.username FROM Documents d JOIN Users u ON d.user_id = u.id ORDER BY d.uploaded_at DESC";
        return sqlsrv_query($this->conn, $sql);
    }

    public function getUserDocuments($user_id) {
        $sql = "SELECT * FROM Documents WHERE user_id = ? ORDER BY uploaded_at DESC";
        return sqlsrv_query($this->conn, $sql, [$user_id]);
    }
}?>
