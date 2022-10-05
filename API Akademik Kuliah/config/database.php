<?php
class Database
{
    // konfigurasi database
    private $host = "localhost";
    private $db_name = "myhellow_akademik";
    private $username = "myhellow_akademik";
    private $password = "syahalam28";
    public $conn;
    // koneksi database
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
