## Mulai

Sebelum melakukan instalasi proyek `pinjam-ruang` ada baiknya perhatikan hal-hal berikut ini:

### Prasyarat

Sebelum menggunakan projek ini, diperlukanya:

-   [composer](https://getcomposer.org/)
-   [php](https://www.php.net/downloads.php)
-   [git](https://git-scm.com/)

### Instalasi

1. Unduh/Clone proyek ini
    ```git
    git clone https://github.com/EgiStr/pinjamruang-km-itera.git
    ```
2. Lalu pindah ke direktori `pinjam-ruang`
    ```sh
    cd pinjam-ruang
    ```
3. Install komponen yang diperlukan menggunakan composer
    ```sh
    composer install
    ```
4. Copy file `.env.example` menjadi `.env`
    ```sh
    cp .env.example .env
    ```
5. Lalu generate `APP_KEY`
    ```sh
    php artisan key:generate
    ```
6. Lalu lakukan migrasi database dan query seed
    ```sh
    php artisan migrate:fresh --seed
    ```
7. Setelah berhasil, jalankan aplikasi
    ```sh
    php artisan serve
    ```
8. Lalu buka browser `127.0.0.1:8000` untuk menggunakan aplikasi
9. Selamat meminjam ruangan dengan mudah dan cepat 😊
