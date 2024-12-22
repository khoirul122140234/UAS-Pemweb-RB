<?php
// Memulai sesi untuk mengakses informasi sesi yang ada
session_start();

// Menghapus semua data yang disimpan dalam sesi
session_unset();

// Menghancurkan sesi, yang berarti menghapus sesi yang aktif
session_destroy();

// Mengecek apakah cookie 'username' ada, dan jika ada, menghapusnya
if (isset($_COOKIE['username'])) {
    // Menghapus cookie dengan mengatur waktu kadaluarsa di masa lalu
    setcookie("username", "", time() - 100000, "/");
}

// Mengarahkan pengguna kembali ke halaman login (indexlog.php)
header("Location: indexlog.php");

// Menghentikan eksekusi skrip setelah pengalihan
exit();
?>
