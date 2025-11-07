# Website Company Profile - ReadyLab

Ini adalah proyek website company profile untuk "ReadyLab", sebuah perusahaan riset dan pengembangan. Website ini dibangun menggunakan Laravel 12, Tailwind CSS, dan Alpine.js. Proyek ini dilengkapi dengan panel admin (CMS) kustom untuk mengelola semua konten dinamis di website, termasuk dukungan penuh untuk multi-bahasa (Indonesia & Inggris) dan fitur carousel dinamis.

## Fitur Utama

### Frontend (Situs Publik)

  * **Multi-Bahasa:** Dukungan penuh untuk bahasa Indonesia (ID) dan Inggris (EN) di seluruh halaman.
  * **Halaman Dinamis:** Semua konten utama diambil dari database.
  * **Carousel Homepage:** Slide gambar dinamis dengan teks yang bisa diterjemahkan.
  * **Desain Responsif:** Dibuat dengan Tailwind CSS untuk tampilan optimal di semua perangkat.
  * **Interaktivitas:** Menggunakan Alpine.js dan Swiper.js untuk komponen interaktif.

### Backend (CMS Admin)

  * **Autentikasi Kustom:** Sistem login dan logout manual untuk admin.
  * **Perlindungan Route:** Akses admin dilindungi middleware `auth` dan `isAdmin`.
  * **Dashboard Admin:** Antarmuka pengelolaan konten yang lengkap.
  * **Manajemen Konten (CRUD):**
      * Kelola Carousel Homepage
      * Kelola Layanan (Services)
      * Kelola Tim (Team)
      * Kelola FAQ
      * Kelola Tools
      * Kelola R\&D (Projects & Research)
      * Kelola Publikasi & Kategori Publikasi
  * **Manajemen Konten Tunggal:** Halaman "Pengaturan Situs" untuk mengedit elemen teks statis (kontak, tentang kami, dll).
  * **Form Multi-Bahasa:** Input konten menggunakan sistem tab untuk bahasa Indonesia dan Inggris.

-----

## Teknologi yang Digunakan

  * **Backend:** Laravel 12
  * **Frontend:** Tailwind CSS, Alpine.js, Swiper.js
  * **Database:** MySQL
  * **Build Tool:** Vite

-----

## Tutorial Instalasi dan Setup

### Prasyarat

  * PHP \>= 8.2
  * Composer
  * Node.js & NPM
  * Database MySQL

### Langkah-langkah Instalasi

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/Obiwannn11/web-company-profile-research-laravel-12.git
    cd web-company-profile-research-laravel-12
    ```

2.  **Install Dependensi**

    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    *Konfigurasikan database di file `.env`.*

4.  **Setup Database & Storage**

    ```bash
    php artisan migrate:fresh --seed
    php artisan storage:link
    ```

5.  **Jalankan Aplikasi**
    Buka dua terminal terpisah:

      * Terminal 1: `php artisan serve`
      * Terminal 2: `npm run dev`

6.  **Akses**

      * Web Publik: `http://127.0.0.1:8000`
      * Admin Login: `http://127.0.0.1:8000/admin/login` (Email: `admin@readylab.com`, Password: `password`)

-----

## Panduan Pengembangan

### Menambahkan Bahasa Baru (Manual)

Saat ini, dukungan bahasa (ID/EN) masih didefinisikan secara manual di beberapa file. Untuk menambah bahasa baru (misal: 'fr' untuk Prancis), Anda perlu memperbarui file-file berikut:

1.  **`config/app.php`** (jika ada konfigurasi locale di sini).
2.  **`app/Http/Middleware/SetLocaleMiddleware.php`**: Tambahkan 'fr' ke array `$supportedLocales`.
3.  **`routes/web.php`**: Tambahkan 'fr' ke regex `where` pada grup route locale (opsional jika regex sudah `[a-z]{2}`).
4.  **`app/View/Composers/NavbarComposer.php`**: Tambahkan 'fr' ke array `$supportedLocales` untuk ditampilkan di dropdown/pills navbar.
5.  **View Admin (`create.blade.php` & `edit.blade.php` di semua folder admin)**: Tambahkan tombol tab baru untuk bahasa Prancis dan duplikasi input field untuk `translations[fr][...]`.

### Fitur Mendatang (Coming Soon)

  * **Manajemen Bahasa Dinamis:** Fitur CRUD di admin panel untuk menambah, mengedit, dan menghapus bahasa yang didukung secara langsung tanpa mengubah kode. Sistem akan otomatis menyesuaikan tab di form admin dan pilihan bahasa di navbar.