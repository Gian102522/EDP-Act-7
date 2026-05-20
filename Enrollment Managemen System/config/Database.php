<?php

class Database {
    public $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "2022-9514-13306", "enrollment_db");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>