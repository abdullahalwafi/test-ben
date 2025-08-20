# Aplikasi Web Kumpulan Dataset

Aplikasi ini merupakan sebuah web monolitik yang berfungsi sebagai platform untuk mengelola kumpulan dataset dan file. Aplikasi ini dibuat untuk memenuhi tugas seleksi Programmer dan Data Engineer.

---

## ✨ Fitur Utama

- **Autentikasi Pengguna**: Sistem login untuk mengakses fitur aplikasi.
- **Manajemen Dataset (CRUD)**:
    - Menambahkan, mengedit, dan menghapus dataset.
    - Tampilan data menggunakan *server-side data tables* dengan fungsionalitas pencarian.
    - Mengunggah file Excel, di mana isinya akan diekstrak dan disimpan ke dalam database dalam format JSON.
- **Dashboard Rekapitulasi**:
    - Menampilkan total keseluruhan dataset.
    - Menampilkan total dataset berdasarkan topik dalam bentuk kartu (card).
    - Menyajikan grafik batang untuk total dataset per topik.

---

## 🛠️ Teknologi yang Digunakan

- **Bahasa**: PHP
- **Framework**: Laravel 12
- **Database**: MySQL

---

## 🚀 Instalasi dan Konfigurasi

Untuk menjalankan aplikasi ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/abdullahalwafi/test-ben/](https://github.com/abdullahalwafi/test-ben/)
    cd test-ben
    cp .env.example .env
    composer install
    npm install
    php artisan key:generate
    php artisan migrate --seed
    composer run dev 
    ```

2.  **Konfigurasi Database secara manual**
    Hal ini dilakukan ketika kamu tidak menggunakan php artisan migrate
    - Buat sebuah database baru di MySQL Anda.
    - Impor file `.sql` yang telah disediakan untuk membuat struktur tabel yang diperlukan (`users`, `topik`, `dataset`).
    - **Unduh file SQL di sini**:  [sa](as)
    - buka file .env dan sesuaikan konfigurasi databasenya


3.  **Konfigurasi Koneksi**
    - Sesuaikan pengaturan koneksi database (nama database, user, password) pada file konfigurasi proyek PHP Anda (misalnya `.env`).

4.  **Jalankan Aplikasi**
    - Jalankan server pengembangan lokal Anda dengan mengakses url `http://127.0.0.1:8000`.
    - login menggunakan akun dibawah ini
    - email : `admin@admin.com`
    - pass  : `12345678`
    - jika ingin membuat dataset baru kamu bisa menggunakan data berikut : [databansos.xlsx](as)

---

## 📖 Tahapan Penggunaan Aplikasi

1.  **Login**
    - Akses halaman utama aplikasi dan masuk menggunakan akun yang telah terdaftar di tabel `users`.

2.  **Melihat Dashboard**
    - Setelah berhasil login, Anda akan diarahkan ke halaman **Dashboard**.
    - Di sini Anda dapat melihat rekapitulasi jumlah total dataset dan grafik berdasarkan topik.

3.  **Mengelola Dataset**
    - Masuk ke menu manajemen dataset.
    - Untuk **menambahkan data baru**, klik tombol "Tambah Data".

4.  **Form Tambah/Edit Dataset**
    - **Pilih Topik**: Pilih kategori topik yang sesuai untuk dataset Anda.
    - **Nama Dataset**: Masukkan nama untuk dataset yang akan diunggah.
    - **Upload File**: Unggah file Excel yang berisi data Anda.
        - **Contoh file Excel dapat diunduh di sini**: [Link ke file Excel Anda]
    - **Meta Data Info**: Tambahkan informasi atau deskripsi tambahan mengenai dataset.
    - **Submit**: Klik tombol simpan. Data dari file Excel akan otomatis diubah menjadi format JSON dan disimpan di kolom `meta_data_json`.

5.  **Edit dan Hapus Data**
    - Gunakan tombol "Edit" atau "Hapus" pada tabel untuk mengubah atau menghapus dataset yang sudah ada.