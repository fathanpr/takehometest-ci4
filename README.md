# 🚀 CodeIgniter 4 CRUD Project

Takehome Test PT Century Batteries Indonesia - **CodeIgniter 4**. 

---

## 🧰 Fitur

- CRUD Users
- Repository Pattern
- Database migration & seeder
- Serverside Datatable

---

## ⚙️ Persyaratan Sistem

- PHP >= 8.1
- Composer
- Postgresql
- Git

---

## 📥 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/fathanpr/takehometest-ci4.git
cd takehometest-ci4
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Salin File `.env` dan Konfigurasi

```bash
cp env .env
```

Lalu edit file `.env` dan sesuaikan konfigurasi database:

```dotenv
database.default.hostname = localhost    
database.default.database = db_name (sesuaikan dengan kondisi lokal)
database.default.username = db_username (sesuaikan dengan kondisi lokal)
database.default.password = db_password (sesuaikan dengan kondisi lokal)
database.default.DBDriver = Postgre  
database.default.port     = 5432         
database.default.charset  = utf8
database.default.DBPrefix =  
database.default.pConnect = false
database.default.DBDebug  = true
database.default.swapPre  =  
database.default.encrypt  = false
database.default.compress = false
database.default.strictOn = false
database.default.failover = []
database.default.port     = 5432 
```

---

## 🧱 Migrasi dan Seeder

### 4. Jalankan Migration

```bash
php spark migrate
```

### 5. Jalankan Seeder

```bash
php spark db:seed DatabaseSeeder
```

## 🚀 Jalankan Aplikasi

```bash
php spark serve
```

Akses di browser:

```
http://localhost:8080
```

---

## 📁 Struktur Folder Penting

| Folder | Keterangan |
|--------|------------|
| `app/Controllers/` | Logic untuk handle request (HTTP) |
| `app/Models/`      | Interaksi dengan database |
| `app/Config/Routes/`      | Routing Aplikasi (Endpoint) |
| `app/Repositories/`      | Interaksi dengan Model |
| `app/Service/`      | Interaksi dengan berbagai Repository & dilakukan DI ke Controller |
| `app/Views/`       | File tampilan HTML |
| `app/Database/Migrations/` | Struktur tabel database |
| `app/Database/Seeds/`      | Data awal database |

---

## 🧑‍💻 Author

Created by [Fathan Pebrilliestyo Ridwan](https://github.com/fathanpr)  
Dibuat untuk mengikuti test rekrutmen di PT Century Batteries Indonesia.