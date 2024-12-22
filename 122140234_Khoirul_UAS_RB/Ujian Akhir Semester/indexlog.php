<?php
// Menyertakan file hash_existing_passwords.php yang mungkin berisi fungsi untuk memverifikasi password
include 'includes/hash_existing_passwords.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Menyertakan Bootstrap CSS untuk tampilan yang responsif dan menarik -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <!-- Card untuk form login -->
    <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%; margin-top: 50px;">
        <h2 class="text-center mb-4">Login Form</h2>
        <!-- Form untuk login, mengirimkan data ke login.php -->
        <form id="login-form" action="login.php" method="POST">
            <!-- Input untuk username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <!-- Input untuk password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- Checkbox untuk menyetujui Terms and Conditions -->
            <div class="mb-3">
                <input type="checkbox" id="termsAndConditions" class="form-check-input">
                <label for="termsAndConditions" class="form-check-label">I agree to the Terms and Conditions</label>
            </div>
            <!-- Checkbox untuk opsi "Remember me" -->
            <div class="mb-3">
                <input type="checkbox" id="rememberMe" class="form-check-input" name="rememberMe">
                <label for="rememberMe" class="form-check-label">Remember me</label>
            </div>
            <!-- Tombol login -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <!-- Tempat untuk menampilkan pesan error jika login gagal -->
        <div id="error-message" style="color: red; display: none; margin-top: 15px;"></div>
    </div>
</div>
<!-- Menyertakan Popper.js untuk Bootstrap (untuk tooltips, dropdowns, dll) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Menyertakan Bootstrap JS untuk interaktivitas -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3-alpha1/dist/js/bootstrap.min.js"></script>
<!-- Menyertakan script login.js untuk menangani logika client-side (misal: validasi form) -->
<script src="assets/login.js"></script>
</body>
</html>
