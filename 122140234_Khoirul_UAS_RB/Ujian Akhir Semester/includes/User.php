<?php
// Menyertakan file konfigurasi database
include_once 'db_config.php';

// Membuat class User untuk menangani proses login pengguna
class User
{
    private $db; // Menyimpan objek database untuk digunakan dalam class

    // Konstruktor untuk menerima objek database sebagai parameter
    public function __construct($db)
    {
        $this->db = $db; // Menyimpan objek database ke dalam properti $db
    }

    // Method untuk melakukan login pengguna
    public function login($username, $password, $rememberMe)
    {
        // Query untuk mencari pengguna berdasarkan username
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->conn->prepare($sql); // Persiapkan statement SQL
        // Bind parameter username ke query
        $stmt->bind_param("s", $username);
        $stmt->execute(); // Eksekusi query
        $result = $stmt->get_result(); // Ambil hasil dari eksekusi query

        // Jika username ditemukan di database
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc(); // Ambil data pengguna yang ditemukan
            // Verifikasi apakah password yang dimasukkan cocok dengan yang ada di database
            if (password_verify($password, $user['password'])) {
                // Set session username jika login berhasil
                $_SESSION['username'] = $username;
                // Jika pengguna memilih untuk diingat (remember me), set cookie dengan username
                if ($rememberMe) {
                    setcookie("username", $username, time() + (30 * 24 * 60 * 60), "/"); // Cookie berlaku selama 30 hari
                }
                // Kembalikan status sukses dan redirect ke halaman index.php
                return ['success' => true, 'redirect' => 'index.php'];
            } else {
                // Jika password salah, kembalikan status gagal dengan pesan error
                return ['success' => false, 'message' => 'Password salah.'];
            }
        } else {
            // Jika username tidak ditemukan di database, kembalikan status gagal dengan pesan error
            return ['success' => false, 'message' => 'Username tidak ditemukan.'];
        }
    }
}
?>
