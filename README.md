# 🚀 CRM Project App (Laravel 12 + React + Inertia.js)

Aplikasi CRM sederhana untuk mengelola **Leads, Projects/Deal Pipeline, Customers Aktif, Reporting** dengan fitur:
- Authentication (Laravel Breeze + Inertia + React)
- Manajemen Lead & Project
- Approval Project (waiting_approval → approved → rejected)
- Konversi otomatis Project → Customer
- Manajemen Customer Aktif
- Reporting (filter periode + export Excel)
- Audit log (opsional)

---

## 📦 Tech Stack
- **Backend**: Laravel 12 (PHP ^8.2)
- **Frontend**: React + Inertia.js + Breeze
- **Database**: MySQL/MariaDB
- **Export Excel**: maatwebsite/excel ^3.1
- **Auth**: Laravel Breeze + Sanctum

---

## ⚙️ Persyaratan
Sebelum menjalankan, pastikan sudah terinstall:
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL/MariaDB
- Extension PHP:
  - `ext-pdo`
  - `ext-mbstring`
  - `ext-gd` (wajib untuk export Excel)
  - `ext-zip`

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Clone repository
```bash
git clone https://github.com/USERNAME/ardy_crm.git
cd ardy_crm
```

### 2. Install dependency backend (Laravel)
```bash
composer install
```

### 3. Install dependency frontend (React + Vite)
```bash
npm install
```

### 4. Konfigurasi environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Atur database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_db
DB_USERNAME=root
DB_PASSWORD=
```

Atur juga **APP_URL**:
```env
APP_URL=http://localhost:8000
```

### 5. Generate key Laravel
```bash
php artisan key:generate
```

### 6. Migrasi database & seeding
```bash
php artisan migrate --seed
```

Seeder akan membuat user default:
- **Manager** → `manager@example.com / password`
- **Sales** → `sales@example.com / password`

### 7. Jalankan aplikasi
Jalankan Laravel server:
```bash
php artisan serve
```

Jalankan Vite (React):
```bash
npm run dev
```

Aplikasi bisa diakses di:
```
http://localhost:8000
```

---

## 📊 Fitur Utama

### 🔹 Lead Management
- Tambah, ubah, hapus lead
- Setiap lead bisa dijadikan project

### 🔹 Project / Deal Pipeline
- Buat project dari lead
- Tambahkan produk & nego harga
- Jika harga nego < harga jual → status `waiting_approval`
- Manager bisa **Approve/Reject**
- Jika approved → otomatis dibuat menjadi **Customer Aktif**

### 🔹 Customer Aktif
- Menampilkan customer yang sudah berlangganan
- Setiap customer bisa punya lebih dari 1 produk
- Hanya Manager yang bisa melihat semua data, Sales hanya melihat datanya sendiri

### 🔹 Reporting
- Laporan project berdasarkan periode (tanggal mulai - tanggal akhir)
- Data bisa diexport ke Excel (`.xlsx`)

---

## 📂 Struktur Direktori
```
app/
 ┣ Exports/         → Export Excel (ProjectsExport, CustomersExport)
 ┣ Http/
 ┃ ┗ Controllers/   → Business logic (ProjectController, ReportController, dll)
 ┣ Models/          → Eloquent Models (Lead, Project, Product, Customer)
resources/js/       → React + Inertia frontend
routes/web.php      → Route aplikasi
```

---

## 📤 Export Excel

### Export Project Report
```bash
http://localhost:8000/reports/export?start_date=2025-01-01&end_date=2025-01-31
```

File `projects_report.xlsx` akan otomatis terunduh.

---

## 🛠️ Development Tools

### Reset database
```bash
php artisan migrate:fresh --seed
```

### Clear cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

---

## 📌 License
MIT License.  

---

## ✨ Author
- Dibuat sebagai coding test fullstack **Laravel 12 + React + Inertia.js**  
- Developer: [HARDKNOCKDAYS](https://github.com/HARDKNOCKDAYS)
