<?php
// database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'marketplace';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function getCartas() {
        $stmt = $this->conn->query("SELECT * FROM cartas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
