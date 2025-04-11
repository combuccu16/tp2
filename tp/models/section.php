<?php
require_once '../../config/config.php';
class Section
{
    private $db;
    private $conn;
    private $table_name = "section";

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function create($designation, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " ( designation, description) VALUES ( :designation, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':description', $description);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }

    public function update($id, $designation, $description)
    {
        $query = "UPDATE " . $this->table_name . " SET designation = :designation, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':description', $description);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getSections($limit, $offset)
    {
        $query = "SELECT * FROM " . $this->table_name . " LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
