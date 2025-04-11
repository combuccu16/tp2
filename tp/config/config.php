<?php
class Database
{
    private $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=tp", "root", "");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
