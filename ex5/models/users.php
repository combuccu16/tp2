<?php
require_once "../../config/config.php";
class Users
{
    private $conn;
    private $db;
    private $table_name = "utilisateur";

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }


    public function check($email, $username)
    {
        // security measures
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email and username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_name'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $row['role'];
            return true;
        }
        return false;
    }
}
