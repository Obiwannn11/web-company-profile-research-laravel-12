# Website Company Profile - ReadyLab

Ini adalah proyek website company profile untuk "ReadyLab", sebuah perusahaan riset dan pengembangan. Website ini dibangun menggunakan Laravel 12, Tailwind CSS, dan Alpine.js. Proyek ini dilengkapi dengan panel admin (CMS) kustom untuk mengelola semua konten dinamis di website, termasuk dukungan penuh untuk multi-bahasa (Indonesia & Inggris).

## Fitur Utama

### Frontend (Situs Publik)

  * **Multi-Bahasa:** Dukungan penuh untuk bahasa Indonesia (ID) dan Inggris (EN) di seluruh halaman.
  * **Halaman Dinamis:** Semua konten utama (Layanan, Proyek R\&D, Publikasi, Tools, Tim, FAQ) diambil dari database.
  * **Desain Responsif:** Dibuat dengan Tailwind CSS untuk tampilan optimal di desktop, tablet, dan mobile.
  * **Interaktivitas:** Menggunakan Alpine.js untuk fitur seperti dropdown menu, accordion, dan tab interaktif.

### Backend (CMS Admin)

  * **Autentikasi Kustom:** Sistem login dan logout manual untuk admin.
  * **Perlindungan Route:** Halaman admin dilindungi oleh middleware untuk memastikan hanya admin yang bisa mengakses.
  * **Dashboard Admin:** Layout admin yang fungsional dengan sidebar dan topbar.
  * **Manajemen Konten (CRUD):**
      * Kelola Layanan (Services)
      * Kelola Tim (Team)
      * Kelola FAQ
      * Kelola Tools
      * Kelola R\&D (Projects & Research)
      * Kelola Publikasi beserta Kategorinya.
  * **Manajemen Konten Tunggal:** Halaman "Pengaturan Situs" untuk mengedit elemen teks di seluruh website (seperti teks hero, info kontak, dll).
  * **Form Multi-Bahasa:** Semua form di admin panel menggunakan sistem tab untuk memudahkan input konten dalam bahasa Indonesia dan Inggris.

-----

## Teknologi yang Digunakan

  * **Backend:** Laravel 12
  * **Frontend:** Tailwind CSS, Alpine.js
  * **Database:** MySQL
  * **Build Tool:** Vite

-----

## Tutorial Instalasi dan Setup

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal.

### Prasyarat

  * PHP \>= 8.2
  * Composer
  * Node.js & NPM
  * Database (misalnya, MySQL)

### Langkah-langkah Instalasi

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/Obiwannn11/web-company-profile-research-laravel-12.git
    cd web-company-profile-research-laravel-12
    ```

2.  **Install Dependensi PHP**

    ```bash
    composer install
    ```

3.  **Setup File `.env`**
    Salin file `.env.example` menjadi `.env`.

    ```bash
    cp .env.example .env
    ```

    Kemudian, buka file `.env` dan konfigurasikan koneksi database Anda:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=password_anda
    ```

4.  **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi & Seeder**
    Perintah ini akan membuat semua tabel database dan mengisinya dengan data awal, termasuk data admin.

    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Buat Symbolic Link untuk Storage**
    Ini penting agar file yang di-upload (gambar, logo) bisa diakses publik.

    ```bash
    php artisan storage:link
    ```

7.  **Install Dependensi JavaScript**

    ```bash
    npm install
    ```

8.  **Jalankan Server**
    Anda perlu menjalankan **dua server** secara bersamaan di **dua terminal terpisah**.

      * Di **Terminal 1**, jalankan server PHP Laravel:

        ```bash
        php artisan serve
        ```

      * Di **Terminal 2**, jalankan server Vite untuk kompilasi Tailwind CSS & JS:

        ```bash
        npm run dev
        ```

9.  **Akses Website**

      * **Situs Publik:** [http://127.0.0.1:8000](https://www.google.com/search?q=http://127.0.0.1:8000)
      * **Login Admin:** [http://127.0.0.1:8000/admin/login](https://www.google.com/search?q=http://127.0.0.1:8000/admin/login)

    **Kredensial Admin Awal:**

      * **Email:** `admin@readylab.com`
      * **Password:** `password`

-----

## Penjelasan Fitur Translasi

Sistem translasi di proyek ini dibangun secara manual tanpa library eksternal untuk kontrol penuh dan pemahaman mendasar. Ada dua pola utama yang digunakan:

### 1\. Pola Konten CRUD (Tabel Terjemahan)

Pola ini digunakan untuk konten yang bisa memiliki banyak item (seperti Services, Team, FAQ, dll).

  * Setiap model utama (misal: `Service.php`) memiliki tabel `services`.
  * Tabel ini dihubungkan dengan relasi `hasMany` ke model `ServiceTranslation.php` yang memiliki tabel `service_translations`.
  * Tabel `service_translations` berisi kolom `service_id`, `locale` ('id' atau 'en'), dan kolom-kolom teks yang bisa diterjemahkan (`title`, `description`, `content`).

### 2\. Pola Konten Tunggal (`site_contents`)

Pola ini digunakan untuk elemen-elemen teks di website yang sifatnya tunggal dan hanya perlu di-update (bukan di-create atau di-delete oleh admin).

  * Tabel `site_contents` berfungsi sebagai kamus yang menyimpan **kunci** unik (misal: `hero_title`).
  * Tabel `site_content_translations` menyimpan **nilai** dari setiap kunci dalam berbagai bahasa.
  * Di panel admin, terdapat halaman "Pengaturan Situs" yang memungkinkan admin mengedit semua nilai ini di satu tempat, memberikan fleksibilitas tanpa harus mengubah kode.

-----

## (BONUS) Menambahkan Fitur Carousel (Masih Perencanaan)

Berikut adalah cara menambahkan fitur carousel dinamis di homepage yang kontennya bisa dikelola dari admin.

### Langkah 1: Database (Migration & Model)

1.  Buat file migrasi dan model.

    ```bash
    php artisan make:migration create_carousels_table
    php artisan make:migration create_carousel_translations_table
    php artisan make:model Carousel
    php artisan make:model CarouselTranslation
    ```

2.  Isi file migrasi.

    **`..._create_carousels_table.php`**

    ```php
    Schema::create('carousels', function (Blueprint $table) {
        $table->id();
        $table->string('image');
        $table->string('link_url')->nullable();
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
    ```

    **`..._create_carousel_translations_table.php`**

    ```php
    Schema::create('carousel_translations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('carousel_id')->constrained()->onDelete('cascade');
        $table->string('locale')->index();
        $table->string('caption')->nullable();
        $table->text('subtitle')->nullable();
    });
    ```

3.  Jalankan migrasi.

    ```bash
    php artisan migrate
    ```

4.  Isi model `Carousel.php` dan `CarouselTranslation.php` dengan `$fillable` dan relasinya, sama seperti model `Service` dan `ServiceTranslation`.

### Langkah 2: Admin Panel (CRUD)

Buat CRUD lengkap untuk "Carousel" di admin panel. Ikuti pola yang sama persis seperti yang telah kita lakukan untuk **Services**, **Team**, atau **FAQ**, meliputi:

  * Route di `web.php`.
  * `Admin/CarouselController` baru.
  * View `index`, `create`, dan `edit` di dalam `resources/views/admin/carousels/`.
  * Link baru di sidebar admin.

### Langkah 3: Integrasi ke Frontend

1.  **Install Swiper.js** (library carousel yang populer).
    ```bash
    npm install swiper
    ```
2.  **Update `PageController`**
    Tambahkan logika untuk mengambil data carousel di method `home()`.
    ```php
    // app/Http/Controllers/PageController.php
    use App\Models\Carousel; // Tambahkan import

    public function home(): View
    {
        // ... kode lain ...
        $carousels = Carousel::with('translations')->orderBy('sort_order', 'asc')->get();

        return view('pages.home', compact('featuredServices', 'heroContent', 'carousels'));
    }
    ```
3.  **Update `app.js`**
    Inisialisasi Swiper di `resources/js/app.js`.
    ```javascript
    // resources/js/app.js
    import Swiper from 'swiper/bundle';
    import 'swiper/css/bundle'; // Impor CSS Swiper

    // ... kode Alpine.js ...

    // Inisialisasi Swiper
    document.addEventListener('DOMContentLoaded', () => {
        const swiper = new Swiper('.swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
    ```
4.  **Update View `home.blade.php`**
    Tambahkan struktur HTML untuk Swiper di `resources/views/pages/home.blade.php`, misalnya setelah Hero Section.
    ```html
    {{-- Carousel Section --}}
    <div class="container mx-auto px-6 py-12">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($carousels as $carousel)
                    @php($translation = $carousel->translations->firstWhere('locale', app()->getLocale()))
                    <div class="swiper-slide">
                        <div class="relative h-96 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $carousel->image) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-8">
                                <div>
                                    <h2 class="text-3xl font-bold text-white">{{ $translation->caption ?? '' }}</h2>
                                    <p class="text-lg text-gray-200 mt-2">{{ $translation->subtitle ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    ```


    ## (BONUS) Menambahkan berbagai banyak bahasa (Multi Bahasa atau Lebih dari 2 Bahasa) (Masih Perencanaan)