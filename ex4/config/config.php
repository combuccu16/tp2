<?php
class Config
{
    private $db;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=ex4', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getConnection()
    {
        return $this->db;
    }
}
