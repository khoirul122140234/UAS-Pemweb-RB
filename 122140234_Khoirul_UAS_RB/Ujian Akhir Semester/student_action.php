<?php
// Memulai sesi untuk mengakses informasi sesi yang ada
session_start();

// Mengimpor konfigurasi database dan class Student
include 'includes/db_config.php';
include 'includes/Student.php';

// Membuat objek database dan objek Student
$student = new Student($db);

// Mengambil aksi yang dikirimkan dari form
$action = $_POST['action'] ?? '';  

// Fungsi untuk memvalidasi input
function validateInput($data, $fieldName) {
    if (empty($data)) {
        return "$fieldName tidak boleh kosong.";  // Mengembalikan pesan jika input kosong
    }
    return '';
}

// Proses jika aksi adalah 'add' (menambahkan data)
if ($action === 'add') {
    // Mengambil data dari form dan menghapus spasi di awal/akhir
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $jurusan = trim($_POST['jurusan']);
    $email = trim($_POST['email']);
    
    // Mendapatkan informasi browser dan IP pengguna
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // Validasi input
    $errors = [];
    $errors[] = validateInput($nama, 'Nama');
    $errors[] = validateInput($nim, 'NIM');
    $errors[] = validateInput($jurusan, 'Jurusan');
    $errors[] = validateInput($email, 'Email');

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }

    // Jika ada error, kembalikan ke halaman dengan pesan error
    if (!empty(array_filter($errors))) {
        $_SESSION['errors'] = $errors;  // Menyimpan pesan error dalam sesi
        header("Location: index.php?message=Gagal menambahkan data");  // Pengalihan dengan pesan
        exit();
    }

    // Jika tidak ada error, tambahkan data mahasiswa
    if ($student->addStudent($nama, $nim, $jurusan, $email, $browser, $ip)) {
        header("Location: index.php?message=Data berhasil ditambahkan");  // Pengalihan sukses
    } else {
        header("Location: index.php?message=Gagal menambahkan data");  // Pengalihan gagal
    }
} 
// Proses jika aksi adalah 'update' (memperbarui data)
elseif ($action === 'update') {
    $id = $_POST['id'];
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $jurusan = trim($_POST['jurusan']);
    $email = trim($_POST['email']);

    // Validasi input
    $errors = [];
    $errors[] = validateInput($nama, 'Nama');
    $errors[] = validateInput($nim, 'NIM');
    $errors[] = validateInput($jurusan, 'Jurusan');
    $errors[] = validateInput($email, 'Email');

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }

    // Jika ada error, kembalikan ke halaman dengan pesan error
    if (!empty(array_filter($errors))) {
        $_SESSION['errors'] = $errors;  // Menyimpan pesan error dalam sesi
        header("Location: index.php?message=Gagal memperbarui data");  // Pengalihan dengan pesan
        exit();
    }

    // Jika tidak ada error, perbarui data mahasiswa
    if ($student->updateStudent($id, $nama, $nim, $jurusan, $email)) {
        header("Location: index.php?message=Data berhasil diperbarui");  // Pengalihan sukses
    } else {
        header("Location: index.php?message=Gagal memperbarui data");  // Pengalihan gagal
    }
} 
// Proses jika aksi adalah 'delete' (menghapus data)
elseif ($action === 'delete') {
    $id = $_POST['id'];

    // Validasi ID mahasiswa yang ingin dihapus
    if (empty($id)) {
        $_SESSION['errors'] = ["ID mahasiswa tidak ditemukan."];  // Menyimpan pesan error dalam sesi
        header("Location: index.php?message=Gagal menghapus data");  // Pengalihan gagal
        exit();
    }

    // Jika ID valid, hapus data mahasiswa
    if ($student->deleteStudent($id)) {
        header("Location: index.php?message=Data berhasil dihapus");  // Pengalihan sukses
    } else {
        header("Location: index.php?message=Gagal menghapus data");  // Pengalihan gagal
    }
}
?>
