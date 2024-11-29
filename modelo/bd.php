<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'DejaTuHuella_bd';
    private $conn;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        if (is_null($this->conn)) {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
?>
