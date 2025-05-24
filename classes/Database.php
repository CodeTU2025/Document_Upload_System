<?php
class Database {
    private $server = "DESKTOP-GEQ0IO2";
    private $database = "document_upload_system";
    private $user = "";
    private $password = "";
    public $conn;

    public function connect() {
        $connectionInfo = [
            "Database" => $this->database,
            "UID" => $this->user,
            "PWD" => $this->password,
            "CharacterSet" => "UTF-8"
        ];
        $this->conn = sqlsrv_connect($this->server, $connectionInfo);
        if (!$this->conn) {
            die(print_r(sqlsrv_errors(), true));
        }
        return $this->conn;
    }
}
