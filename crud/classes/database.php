<?php 
class Database {

    private $host = "localhost";
    private $dbName = "test01";
    private $userName = "root";
    private $password = "thuat1810";

    public $conn;

    public function dbConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
        } catch (PDOException $exception) {
            echo "connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>