# web-gis
 Kelompok 7 Mata Kuliah Sistem Informasi Geografis

# Konfigurasi Aplikasi Web GIS

## 1. Persiapan Lingkungan
- Pastikan sudah terinstall PHP, Composer, Node.js, dan database (misal: SQLite/MySQL).
- Clone repository ini ke folder lokal Anda.

## 2. Instalasi Dependency
- Jalankan perintah berikut di terminal:
  ```
  composer install
  npm install
  ```

## 3. Konfigurasi Environment
- Salin file `.env.example` menjadi `.env`:
  ```
  cp .env.example .env
  ```
- Edit file `.env` sesuai kebutuhan, terutama bagian:
  - `APP_NAME`, `APP_URL`
  - Konfigurasi database (`DB_CONNECTION`, `DB_DATABASE`, dst)
  menjadi seperti ini
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=web-gis
  DB_USERNAME=root
  DB_PASSWORD=

## 4. Generate Key
- Jalankan perintah:
  ```
  php artisan key:generate
  ```

## 5. Menjalankan Aplikasi
- Jalankan server lokal:
  ```
  php artisan serve
  ```

