<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $db_name = "note";
    public $connect;

    public function getConnection() {
        $this->connect = null;
        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username);
            $this->connect->exec("set names utf8");
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection Error: " . $exception->getMessage();
        }
        return $this->connect;
    }
}
    
?>