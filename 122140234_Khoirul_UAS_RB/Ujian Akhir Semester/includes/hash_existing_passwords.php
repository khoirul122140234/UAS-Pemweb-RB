<?php
// Menyertakan file konfigurasi database untuk koneksi
include_once 'db_config.php';

// Query untuk mengambil data pengguna dari tabel 'users'
$sql = "SELECT id, username, password FROM users";
$result = $db->query($sql);

// Loop untuk memeriksa setiap baris data pengguna
while ($row = $result->fetch_assoc()) {
    // Mengambil ID dan password pengguna
    $id = $row['id'];
    $plainPassword = $row['password'];

    // Memeriksa apakah password belum di-hash dengan memeriksa informasi algoritma
    if (!password_get_info($plainPassword)['algo']) {
        // Jika password belum di-hash, hash password dengan algoritma default
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        // Query untuk memperbarui password pengguna dengan password yang sudah di-hash
        $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE id = $id";
        $db->query($updateSql);

        // Menampilkan pesan bahwa password berhasil di-hash untuk pengguna tertentu
        echo "Password untuk user ID $id berhasil dihash.<br>";
    }
}

// Menutup koneksi database setelah selesai
$db->close();
?>
