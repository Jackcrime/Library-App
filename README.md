# 📚 Library App – Aplikasi Peminjaman Buku Online

Aplikasi web peminjaman buku online berbasis Laravel. User dapat meminjam buku secara online dan mengambilnya langsung di perpustakaan. Jika terlambat mengembalikan buku, sistem akan mengirimkan email denda otomatis sebesar Rp10.000.

---

## 🚀 Fitur Utama

### 👤 User Panel
- Register & Login
- Lupa Password (reset via email Gmail SMTP)
- Melihat daftar buku & detail
- Meminjam buku secara online
- Bookmark buku untuk dipinjam nanti
- Tandai buku favorit
- Melihat status peminjaman dan pengembalian
- Email notifikasi jika terlambat mengembalikan buku (denda Rp10.000)

### 🛠️ Admin Panel
- Login khusus role `admin`
- Dashboard admin
- CRUD buku, kategori, dan data peminjaman
- Persetujuan & pengembalian peminjaman
- Kirim email denda ke user
- Melihat laporan peminjaman dan daftar user yang belum mengembalikan buku

---

## 🔧 Teknologi & Versi yang Digunakan

### 🖥️ Backend
- **Laravel**: v11.x
- **PHP**: v8.3
- **MySQL**: v8.0+
- **Email SMTP**: Gmail (gsmtp) + App Password
- **Authentication**: Manual berbasis role (`admin`, `user`)

### 🧩 Frontend (CDN-based – Full Online)

#### Admin Panel
| Library         | Versi   |
|-----------------|---------|
| TailwindCSS     | v3.4.1  |
| AlpineJS        | v3.13.5 |
| DropzoneJS      | v5.9.3  |
| Lucide Icon     | v0.271.0|
| SweetAlert2     | v11.10.0|
| Font Awesome    | v6.5.1  |

#### User Panel
| Library         | Versi   |
|-----------------|---------|
| TailwindCSS     | v3.4.1  |
| AlpineJS        | v3.13.5 |
| SweetAlert2     | v11.10.0|
| Font Awesome    | v6.5.1  |
| AOS Animation   | v2.3.4  |
| Swiper JS       | v11.1.1 |

> ⚠️ Semua library frontend menggunakan **CDN** dan aplikasi harus dijalankan **secara online**.


## 🌐 Alur Akses Aplikasi

1. Buka halaman utama `/` (Welcome Page)
2. Klik tombol **Login / Register**
3. Setelah login:
   - Jika role `admin` → diarahkan ke `/admin`
   - Jika role `user` → masuk ke dashboard `/dashboard`
4. Di halaman user:
   - Lihat daftar buku
   - Bookmark atau tandai sebagai favorit
   - Pinjam buku secara online
5. Email denda otomatis dikirim jika buku belum dikembalikan melewati batas waktu

## 📦 Instalasi & Setup

### 1. Clone Project
```bash
git clone https://github.com/Jackcrime/Library-App.git
cd Library-App
````

### 2. Install Dependency Laravel

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database (.env)

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Email (.env)

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_gmail@gmail.com
MAIL_FROM_NAME="Library App"
```

> 💡 **Gunakan Gmail App Password**: Aktifkan 2FA di akun Gmail → buat App Password → tempelkan ke `MAIL_PASSWORD`

### 6. Migrasi & Seeder

```bash
php artisan migrate --seed
```

Seeder akan membuat akun default admin dan beberapa data dummy.

### 7. Link Storage (jika pakai upload cover buku)

```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

---

## 🧪 Akun Demo (Seeder Default)

### Admin

* Email: `admin@gmail.com`
* Password: `password`

### User

* Email: `user@gmail.com`
* Password: `password`

---

## 📁 Struktur Direktori Penting

```
resources/views/
├── auth/          → Halaman login, register, reset
├── admin/         → Tampilan backend admin
├── user/          → Tampilan frontend user
├── layouts/       → Template Blade
routes/web.php     → Routing utama
app/Mail/          → Template email (denda, reset password)
database/seeders/  → Seeder data awal & akun demo
```

---

## 📩 Email Notifikasi

* **Reset Password**: Email link reset otomatis
* **Denda**: Email otomatis jika user belum kembalikan buku sesuai batas waktu

---

## 🏷️ Fitur Favorit & Bookmark

* **Bookmark**: User bisa menyimpan buku yang ingin dipinjam nanti
* **Favorite**: User bisa tandai buku favorit untuk ditampilkan di dashboard
* Tersimpan berdasarkan `user_id` → relasi dengan `book_id`
* Bisa dikelola dari dashboard user

---

## 🛡️ Keamanan & Akses

* Proteksi middleware berbasis role
* Password dienkripsi dengan bcrypt
* Reset password via token
* Email verifikasi (jika diaktifkan)

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan pengembangan. Bebas dikembangkan dan dimodifikasi sesuai kebutuhan.

---

## ✨ Developer

**Nama**: \[Nama Kamu]
**GitHub**: [https://github.com/Jackcrime](https://github.com/Jackcrime)
