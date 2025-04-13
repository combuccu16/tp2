<?php
require_once "../../config/config.php";
class Student
{
    private $db;
    private $conn;
    public function __construct()
    {
        $this->db = new Config();
        $this->conn = $this->db->getConnection();
    }
    public function getStudentById($id)
    {
        $query = "SELECT * FROM student WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllStudents()
    {
        $query = "SELECT * FROM student";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
