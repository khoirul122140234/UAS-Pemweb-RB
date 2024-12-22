<?php
// Mendefinisikan class Database untuk menangani koneksi dan query ke database
class Database {
    public $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->conn = new mysqli($host, $user, $password, $dbname);
        
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}

// Mengatur detail koneksi database
$host = "sql202.infinityfree.com";
$user = "if0_37964339";
$password = "pNzVcqUXHrQC";
$dbname = "if0_37964339_dataapp"; 

// Membuat objek Database
$db = new Database($host, $user, $password, $dbname);
?>