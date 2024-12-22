// Menunggu hingga DOM sepenuhnya dimuat sebelum menjalankan kode
document.addEventListener("DOMContentLoaded", function () {
    // Mencari cookie dengan nama 'username' dan mengambil nilainya
    const usernameCookie = document.cookie
        .split('; ')  // Memecah cookie berdasarkan tanda semicolon
        .find(row => row.startsWith('username='))  // Mencari cookie yang dimulai dengan 'username='
        ?.split('=')[1];  // Memisahkan berdasarkan '=' dan mengambil nilai setelahnya

    // Jika cookie 'username' ditemukan, masukkan nilainya ke dalam input dengan id 'username'
    if (usernameCookie) {
        document.getElementById("username").value = usernameCookie;
    }
});

// Menambahkan event listener untuk form login saat form disubmit
document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();  // Mencegah form dari pengiriman default

    // Mengambil nilai input form
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let termsAndConditions = document.getElementById("termsAndConditions").checked;  // Menyimpan status checkbox
    let rememberMe = document.getElementById("rememberMe").checked ? 1 : 0;  // Menyimpan status 'Remember Me'

    // Menyembunyikan pesan error yang ada
    const errorMessageElement = document.getElementById("error-message");
    errorMessageElement.style.display = "none";
    errorMessageElement.textContent = "";

    // Validasi: Pastikan semua field terisi dan syarat dan ketentuan disetujui
    if (!username || !password || !termsAndConditions) {
        errorMessageElement.style.display = "block";  // Menampilkan pesan error
        errorMessageElement.textContent = "Harap lengkapi semua field dan setujui syarat dan ketentuan!";
        return;  // Menghentikan eksekusi lebih lanjut
    }

    // Mengirim data login ke server menggunakan fetch API
    fetch("login.php", {
        method: "POST",
        body: new URLSearchParams({
            username: username,
            password: password,
            termsAndConditions: termsAndConditions,
            rememberMe: rememberMe })
    })
    .then(response => {
        // Memeriksa apakah respon dari server berhasil (status HTTP OK)
        if (!response.ok) {
            throw new Error('Terjadi kesalahan di server');  // Menangani kesalahan server
        }
        return response.json();  // Mengembalikan respon dalam format JSON
    })
    .then(data => {
        // Memeriksa jika login berhasil berdasarkan data yang diterima dari server
        if (data.success) {
            localStorage.setItem("username", username);  // Menyimpan username di localStorage
            alert("Login berhasil! Anda akan diarahkan ke halaman berikutnya.");
            window.location.href = data.redirect;  // Arahkan pengguna ke URL yang diberikan oleh server
        } else {
            // Jika login gagal, tampilkan pesan error
            errorMessageElement.style.display = "block";
            errorMessageElement.textContent = data.message;
        }
    })
    .catch(error => {
        // Menangani kesalahan lain seperti masalah jaringan atau kesalahan sistem
        console.error("Terjadi kesalahan:", error);
        errorMessageElement.style.display = "block";
        errorMessageElement.textContent = "Terjadi kesalahan pada sistem.";
    });
});
