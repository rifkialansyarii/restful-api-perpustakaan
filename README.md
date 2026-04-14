# README
Repository ini dibuat untuk memenuhi tugas mata kuliah Pemrograman Web, dimana saya diminta untuk membuat sebuah Restful API dengan tema Sistem Informasi Perpustakaan. 

## Feature:
- CRUD Data Peminjaman
- CRUD Data Buku
- CRUD Data Author
- CRUD Data Kategori Buku
- CRUD Data Publisher
- CRUD Data User

>Note: Belum memiliki fitur login

## How to run it?

Buat file .env:

```bash
cp backend/.env.example backend/.env
```

Sesuaikan valuenya (khusus sqlite saja):

```text
#DATABASE CONNECTION
DB_CONNECTION=sqlite
DB_DATABASE=database-name
```

Sesuaikan backend/entrypoint.sh:

```bash
# SNIP CODE #

DB_DIR="database/data"
DB_FILE="$DB_DIR/<your-name-database>.db3"

# SNIP CODE #
```

Jalankan perintah berikut:

```bash
docker compose up --build -d
```

Akses:

```http
http://localhost:8081
````
