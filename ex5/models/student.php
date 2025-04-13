<?php
require_once "../../config/config.php";
class Student
{
    private $conn;
    private $table_name = "etudiant";
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function create($name, $image, $birthday, $section)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, image, birthday, section) VALUES (:name, :image, :birthday, :section)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
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
    public function editStudent($id, $name, $image, $birthday, $section)
    {
        $query = "UPDATE " . $this->table_name . " SET name = :name, image = :image, birthday = :birthday, section = :section WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':section', $section);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getStudents($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentsByName($limit, $offset, $name)
{
    $query = "SELECT * FROM (
                SELECT * FROM " . $this->table_name . " LIMIT :limit OFFSET :offset
              ) AS sub
              WHERE sub.name LIKE :name";
    
    $stmt = $this->conn->prepare($query);
    
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);

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
    public function getAllStudents(){
        $query = "SELECT * FROM " . $this->table_name ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }
    public function countStudents()
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
    public function countStudentsBySection($section)
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE section = :section";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':section', $section);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
    public function getStudentById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
