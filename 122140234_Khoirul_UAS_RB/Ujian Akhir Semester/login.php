<?php
// Memulai sesi untuk menjaga status login pengguna
session_start();

// Menyertakan file konfigurasi database dan class User untuk pengelolaan pengguna
include_once 'includes/db_config.php';
include 'includes/User.php';

// Mengambil data username dan password dari form, dengan trim untuk menghapus spasi ekstra
$username = trim($_POST['username'] ?? ''); // Mengambil username, jika tidak ada nilai, maka kosong
$password = trim($_POST['password'] ?? ''); // Mengambil password, jika tidak ada nilai, maka kosong
$termsAndConditions = $_POST['termsAndConditions'] ?? ''; // Mengecek apakah checkbox Terms and Conditions sudah dicentang
$rememberMe = isset($_POST['rememberMe']) && $_POST['rememberMe'] == '1'; // Mengecek apakah opsi "Remember Me" dicentang

// Menyatakan bahwa respon yang akan dikirim adalah dalam format JSON
header('Content-Type: application/json');

// Mengecek apakah semua field telah diisi, termasuk checkbox Terms and Conditions
if (empty($username) || empty($password) || empty($termsAndConditions)) {
    // Jika ada yang kosong, kirimkan pesan error dalam format JSON
    echo json_encode(['success' => false, 'message' => 'Harap lengkapi semua field dan setujui syarat dan ketentuan!']);
    exit; // Menghentikan eksekusi script lebih lanjut
}

// Membuat objek User untuk mengelola data pengguna
$user = new User($db);

// Memanggil metode login untuk memverifikasi username, password, dan opsi remember me
$response = $user->login($username, $password, $rememberMe);

// Mengirimkan hasil dari proses login dalam format JSON
echo json_encode($response);
?>
