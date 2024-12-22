<?php
// Memulai sesi untuk memeriksa login pengguna menggunakan session atau cookie
session_start();

// Memeriksa apakah session atau cookie 'username' ada, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header('Location: indexlog.php'); // Mengarahkan ke halaman login jika belum login
    exit(); // Menghentikan eksekusi lebih lanjut
}

// Menyertakan file konfigurasi database dan kelas Student
include_once 'includes/db_config.php';
include 'includes/Student.php';

// Membuat objek Database dan Student
$student = new Student($db);

// Mengambil semua data mahasiswa dari database
$students = $student->getAllStudents();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <!-- Menyertakan Bootstrap CSS untuk styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <!-- Menampilkan nama pengguna yang sedang login (dari session atau cookie) -->
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? $_COOKIE['username']); ?>!</h1>
        <!-- Tombol untuk logout -->
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>

        <h2 class="mt-5">Data Mahasiswa</h2>
        
        <!-- Menampilkan pesan jika ada -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <!-- Menampilkan tabel data mahasiswa -->
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Jika ada data mahasiswa, tampilkan dalam tabel -->
                <?php if (count($students) > 0): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['nama']); ?></td>
                            <td><?php echo htmlspecialchars($student['nim']); ?></td>
                            <td><?php echo htmlspecialchars($student['jurusan']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td>
                                <!-- Form untuk menghapus data mahasiswa -->
                                <form action="student_action.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <!-- Tombol untuk membuka modal edit data mahasiswa -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $student['id']; ?>">Edit</button>
                            </td>
                        </tr>

                        <!-- Modal untuk mengedit data mahasiswa -->
                        <div class="modal fade" id="editModal<?php echo $student['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Mahasiswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form untuk mengedit data mahasiswa -->
                                        <form action="student_action.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                            <input type="hidden" name="action" value="update">
                                            <div class="form-group">
                                                <label for="nama">Nama:</label>
                                                <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($student['nama']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nim">NIM:</label>
                                                <input type="text" class="form-control" name="nim" value="<?php echo htmlspecialchars($student['nim']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan:</label>
                                                <input type="text" class="form-control" name="jurusan" value="<?php echo htmlspecialchars($student['jurusan']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Pesan jika tidak ada data mahasiswa -->
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data mahasiswa</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <h2 class="mt-5">Tambah Mahasiswa</h2>
        <!-- Form untuk menambah mahasiswa baru -->
        <form id="student-form" action="student_action.php" method="POST">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan:</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Menyertakan JavaScript untuk Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
