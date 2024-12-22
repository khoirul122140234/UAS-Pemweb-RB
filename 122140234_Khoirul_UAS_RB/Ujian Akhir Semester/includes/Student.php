<?php
// Menyertakan file konfigurasi database
include_once 'db_config.php';

class Student
{
    private $db; // Menyimpan objek database

    // Konstruktor untuk menerima objek database
    public function __construct($db)
    {
        $this->db = $db; // Menyimpan objek database ke dalam properti $db
    }

    // Method untuk mengambil semua data mahasiswa dari database
    public function getAllStudents()
    {
        $sql = "SELECT * FROM mahasiswa"; // Query untuk memilih semua data dari tabel mahasiswa
        $result = $this->db->query($sql); // Eksekusi query menggunakan koneksi database
        $students = []; // Array untuk menampung data mahasiswa

        // Jika ada hasil dari query (lebih dari 0 baris), simpan hasilnya ke dalam array
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row; // Tambahkan data mahasiswa ke dalam array
            }
        }
        return $students; // Kembalikan array berisi data mahasiswa
    }

    // Method untuk menambah data mahasiswa ke dalam database
    public function addStudent($nama, $nim, $jurusan, $email, $browser, $ip_address)
    {
        $sql = "INSERT INTO mahasiswa (nama, nim, jurusan, email, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = $this->db->conn->prepare($sql)) {
            // Bind parameter yang akan digunakan untuk query
            $stmt->bind_param("ssssss", $nama, $nim, $jurusan, $email, $browser, $ip_address);
            if ($stmt->execute()) {
                return true; // Mengembalikan true jika berhasil
            } else {
                // Menangani kesalahan saat eksekusi query
                echo "Error executing query: " . $stmt->error;
                return false;
            }
        } else {
            // Menangani kesalahan saat mempersiapkan statement
            echo "Error preparing statement: " . $this->db->conn->error;
            return false;
        }
    }

    // Method untuk memperbarui data mahasiswa di database
    public function updateStudent($id, $nama, $nim, $jurusan, $email)
    {
        $sql = "UPDATE mahasiswa SET nama = ?, nim = ?, jurusan = ?, email = ? WHERE id = ?";
        if ($stmt = $this->db->conn->prepare($sql)) {
            // Bind parameter untuk query update
            $stmt->bind_param("ssssi", $nama, $nim, $jurusan, $email, $id);
            if ($stmt->execute()) {
                return true; // Mengembalikan true jika berhasil
            } else {
                // Menangani kesalahan saat eksekusi query
                echo "Error executing query: " . $stmt->error;
                return false;
            }
        } else {
            // Menangani kesalahan saat mempersiapkan statement
            echo "Error preparing statement: " . $this->db->conn->error;
            return false;
        }
    }

    // Method untuk menghapus data mahasiswa dari database berdasarkan ID
    public function deleteStudent($id)
    {
        $sql = "DELETE FROM mahasiswa WHERE id = ?";
        if ($stmt = $this->db->conn->prepare($sql)) {
            // Bind parameter ID mahasiswa yang ingin dihapus
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                return true; // Mengembalikan true jika berhasil
            } else {
                // Menangani kesalahan saat eksekusi query
                echo "Error executing query: " . $stmt->error;
                return false;
            }
        } else {
            // Menangani kesalahan saat mempersiapkan statement
            echo "Error preparing statement: " . $this->db->conn->error;
            return false;
        }
    }
}
?>
