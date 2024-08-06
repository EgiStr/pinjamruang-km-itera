## Mulai

Sebelum melakukan instalasi proyek `pinjam-ruang` ada baiknya perhatikan hal-hal berikut ini:

### Prasyarat

Sebelum menggunakan projek ini, diperlukanya:

-   [composer](https://getcomposer.org/)
-   [php](https://www.php.net/downloads.php)
-   [git](https://git-scm.com/)
-   [mysql](https://www.mysql.com/downloads/)

### Instalasi

1. Unduh/Clone proyek ini
    ```git
    git clone https://github.com/EgiStr/pinjamruang-km-itera.git
    ```
2. Lalu pindah ke direktori `pinjamruang-km-itera`
    ```sh
    cd pinjamruang-km-itera
    ```
3. Install komponen yang diperlukan menggunakan composer
    ```sh
    composer install
    ```
4. Copy file `.env.example` menjadi `.env`
    ```sh
    cp .env.example .env
    ```
5. ubah konfigurasi .env sesuai dengan konfigurasi database yang digunakan
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
7. Lalu generate `APP_KEY`
    ```sh
    php artisan key:generate
    ```
8. Lalu lakukan migrasi database dan query seed
    ```sh
    php artisan migrate:fresh --seed
    ```
9. Setelah berhasil, jalankan aplikasi
    ```sh
    php artisan serve
    ```
10. Lalu buka browser `127.0.0.1:8000` untuk menggunakan aplikasi
11. Selamat meminjam ruangan dengan mudah dan cepat 😊
