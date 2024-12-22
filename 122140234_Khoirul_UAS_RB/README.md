### Username Login Website
username: admin
password: 123


# Proyek Web Programming

## Bagian 1: Client-side Programming (Bobot: 30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)
- **Form HTML:**
  - Input teks untuk username.
  - Input password untuk password.
  - Checkbox untuk menyetujui syarat dan ketentuan.
  - Checkbox untuk opsi "Remember Me".
- **Tampilkan Data dari Server:**
  - Data mahasiswa ditampilkan dalam tabel HTML menggunakan PHP untuk mengambil data dari database dan menampilkannya di halaman.
- **Manipulasi DOM dengan JavaScript:**
  - Mengisi input username dari cookie jika tersedia saat halaman dimuat.

### 1.2 Event Handling (15%)
- **Event yang Berbeda:**
  - Event `submit` pada form untuk menangani pengiriman data.
  - Event `click` pada tombol untuk menghapus data mahasiswa.
  - Event `change` pada checkbox untuk mengubah status "Remember Me".
- **Form Validation:**
  - Validasi dilakukan di sisi klien menggunakan JavaScript untuk memastikan:
    - Semua field terisi.
    - Syarat dan ketentuan disetujui sebelum mengirim data ke server.

---

## Bagian 2: Server-side Programming (Bobot: 30%)

### 2.1 Pengelolaan Data dengan PHP (20%)
- **Metode POST:**
  - Formulir menggunakan metode POST untuk mengirim data login dan data mahasiswa.
- **Parsing Data dan Validasi:**
  - Data diambil dari variabel global `$_POST` dan divalidasi untuk memastikan tidak ada field kosong.
- **Simpan ke Basis Data:**
  - Data mahasiswa disimpan ke dalam database, termasuk informasi browser dan alamat IP pengguna.

### 2.2 Objek PHP Berbasis OOP (10%)
- **Class Mahasiswa:**
  - `getAllStudents()`: Mengambil semua data mahasiswa dari database.
  - `addStudent()`: Menambahkan data mahasiswa baru ke database.

---

## Bagian 3: Database Management (Bobot: 20%)

### 3.1 Pembuatan Tabel Database (5%)
- Membuat tabel mahasiswa untuk menyimpan data mahasiswa dengan kolom yang sesuai.

### 3.2 Konfigurasi Koneksi Database (5%)
- Menggunakan class Database untuk mengatur koneksi dengan parameter:
  - `host`, `user`, `password`, dan `database name`.

### 3.3 Manipulasi Data pada Database (10%)
- Metode dalam class Mahasiswa untuk:
  - Menambah data.
  - Memperbarui data.
  - Menghapus data.

---

## Bagian 4: State Management (Bobot: 20%)

### 4.1 State Management dengan Session (10%)
- Menggunakan `session_start()` untuk memulai sesi.
- Menyimpan informasi pengguna (username) ke dalam session.

### 4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
- **Cookie JavaScript:**
  - Menetapkan, mendapatkan, dan menghapus cookie untuk menyimpan username jika opsi "Remember Me" dipilih.
- **Browser Storage JavaScript:**
  - Menggunakan `localStorage` untuk menyimpan informasi pengguna secara lokal.

---

## Bagian Bonus: Hosting Aplikasi Web (Bobot: 20%)

### Langkah-langkah Hosting
1. Menggunakan layanan gratis [InfinityFree](https://infinityfree.net/).
2. Unggah file PHP dan database ke server menggunakan File Manager.
3. Hubungkan aplikasi dengan database MySQL yang disediakan oleh penyedia hosting.
4. Uji aplikasi di domain gratis yang diberikan.

### Penyedia Hosting yang Dipilih
- **InfinityFree**:
  - Gratis.
  - Mendukung PHP dan MySQL.
  - Cocok untuk pengembangan atau pengujian awal.

### Keamanan Aplikasi Web
1. Sembunyikan detail konfigurasi database di file terpisah (`db_config.php`).
2. Batasi akses ke direktori sensitif.
3. Periksa file yang diunggah agar tidak mengandung kerentanan.

### Konfigurasi Server
- Mendukung PHP dan MySQL.
- Mengatur koneksi database dengan hostname, username, dan password.


### Cara membuka Website
LINK : https://uaspemerograman.great-site.net/
Masukkan link terebut pada browser dan saat akses web akan ada konfirmasi dulu pilih Trust atau Advance untuk membuka website.

