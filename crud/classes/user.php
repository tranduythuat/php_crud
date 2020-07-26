<?php 

require_once 'database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    
    public function insert($name, $email)
    {
        try {
            
            $stmt = $this->conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            // die(print_r($stmt));
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($name, $email, $id)
    {
        try {

            $stmt = $this->conn->prepare("UPDATE users SET name = :name, email= :email WHERE id= :id");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);
            // die(print_r($stmt));
            $stmt->execute();
            // print_r($stmt);
            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {

            $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } 

    public function redirect($url)
    {
        header("Location: $url");
    }
}

?>