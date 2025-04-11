<?php
require_once "../../config/config.php";
class Student
{
    private $conn;
    private $table_name = "student";
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function create($name, $birthday, $section)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, birthday, section) VALUES (:name, :birthday, :section)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':section', $section);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteStudent($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function editStudent($id, $name, $birthday, $section)
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, birthday = :birthday, section = :section WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':section', $section);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // we're creating a pagination so we should get students by page using the limit and offset
    public function getStudents($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // we're creating a pagination so we should get students by page using the limit and offset
    public function getStudentsByName($limit, $offset, $name)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE :name LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $name = "%" . $name . "%";
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentsBySection($section, $offset, $limit)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;

        $query = "SELECT * FROM " . $this->table_name . " WHERE section = :section LIMIT $offset, $limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':section', $section);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
