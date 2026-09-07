# Financial Tracker & Money Management App

Aplikasi pencatatan dan pengelolaan keuangan pribadi berbasis web Laravel yang dibuat untuk mata kuliah Evolusi Perangkat Lunak (yang mungkin dapat dikembangkan lebih lanjut untuk keperluan pribadi). Aplikasi ini dirancang untuk membantu pengguna (terutama developer sendiri) dalam mengelola keuangan, budgeting, memantau target tabungan, serta memvisualisasikan kondisi finansial melalui suatu progress bar pada halaman dashboard utama. Aplikasi ini sebenarnya terinspirasi dari aplikasi yang digunakan oleh developer. Hanya saja, melalui mata kuliah ini, developer ingin mencoba membuat aplikasi serupa dengan fitur-fitur yang sedikit berbeda.

---

## Deskripsi Proyek

Mengelola keuangan pribadi seringkali menjadi suatu tantangan jika tidak ada kejelasan mengenai alokasi dana (terutama jika pengguna memiliki beberapa tabungan) dan sisa anggaran yang dimiliki. Oleh karena itu, proyek ini bertujuan untuk membantu menyediakan solusi manajemen keuangan yang bersih, modern, dan mudah digunakan.

### Fitur Utama & Pengembangan:
- **Main Dashboard with Progress Bar**:
  - Tampilan visualisasi berupa progress bar untuk memantau:
    - Persentase pengeluaran terhadap batas anggaran bulanan.
    - Progres pencapaian target tabungan (misalnya ketika ingin membeli barang).
    - Distribusi pengeluaran berdasarkan kategori.
- **Pencatatan Transaksi**:
  - Input transaksi pemasukan dan pengeluaran.
  - Kategorisasi transaksi yang bisa di-custom sesuai keinginan (misalnya: Makanan, Bensin, Hiburan, Tagihan, Gaji, dll.).
  - Melihat riwayat transaksi berdasarkan kategori dan rentang tanggal.
- **Manajemen Anggaran**:
  - Penentuan batas anggaran per kategori maupun total bulanan.
  - Peringatan jika pengeluaran sudah mendekati atau sudah melebihi batas anggaran yang sudah ditentukan.
- **Laporan & Ringkasan Finansial**:
  - Rekap total saldo terkini, total pemasukan, dan total pengeluaran periode berjalan.

---

## Tech Stack

- **Backend**: PHP 8.2 | Laravel 12
- **Frontend**: Blade Templating | Tailwind CSS | Vite
- **Database**: SQLite (default) / MySQL ready
- **Package Manager**: Composer | Node.js / NPM

---

## Prerequisites

Sebelum menjalankan proyek ini, pastikan sistem sudah terinstal:

1. **PHP >= 8.2**.
2. **Composer >= 2.x**.
3. **Node.js >= 18.x & NPM**.
4. **Git**.

---

## Panduan Instalasi

Ikuti beberapa step di bawah ini untuk clone dan menjalankan proyek ini:

### 1. Clone Repository
```bash
git clone https://github.com/EndraZhafir/evolusi-pl-24-538769-SV-24535.git
cd evolusi-pl-24-538769-SV-24535
```

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Setup File Environment (`.env`)
- **Windows (Command Prompt / PowerShell):**
  ```cmd
  copy .env.example .env
  ```
- **Linux / macOS:**
  ```bash
  cp .env.example .env
  ```

### 4. Generate Application Encryption Key
```bash
php artisan key:generate
```

### 5. Setup Database & Jalankan Migrasi
Secara bawaan menggunakan **SQLite**:
```bash
php artisan migrate
```
> **Catatan:** Jika muncul pesan konfirmasi bahwa file database belum ada (`database/database.sqlite`), ketik **`yes`** untuk membuatnya secara otomatis.

### 6. Install Dependensi Frontend & Build Assets
```bash
npm install
npm run build
```

---

## Menjalankan Aplikasi di Server Lokal (2 pilihan)

### 1. Menjalankan Secara Standar
```bash
php artisan serve
```
Jika sedang melakukan pengubahan tampilan (frontend), jalankan juga server Vite di terminal terpisah:
```bash
npm run dev
```

Akses aplikasi melalui browser di **`http://localhost:8000`**

---

### 2. Menggunakan Skrip Otomatis Laravel
```bash
composer run dev
```

---

## Useful Commands (Catatan buat dev juga soalnya kadang lupa)

| Command | Description |
| :--- | :--- |
| `php artisan serve` | Menjalankan server lokal Laravel |
| `npm run dev` | Menjalankan Vite development server dengan hot-reload |
| `npm run build` | Melakukan build file aset CSS/JS untuk produksi |
| `php artisan migrate` | Menjalankan skrip migrasi database |
| `php artisan migrate:fresh` | Mereset dan menjalankan ulang seluruh migrasi |
| `php artisan route:list` | Melihat daftar routing yang terdaftar |
| `php artisan optimize:clear` | Membersihkan cache konfigurasi, route, dan view |

---