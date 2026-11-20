# TP8DPBO2425C1
**Tugas Praktikum 8 — Desain dan Pemrograman Berbasis Objek (MVC PHP)**  
**Irsyad Afif Musyaffa (2508023) — Ilmu Komputer C1 Universitas Pendidikan Indonesia**

Saya Irsyad Afif Musyaffa mengerjakan evaluasi Tugas Praktikum 8 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahan-Nya. Oleh karena itu, saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

Sistem informasi akademik sederhana berbasis **PHP Native (OOP)** dan **MySQL** yang menerapkan pola arsitektur **Model–View–Controller (MVC)** dengan antarmuka **Bootstrap 5**. Aplikasi ini mengelola data utama:
* **Lecturers** (Data Dosen)
* **Courses** (Data Mata Kuliah)

Seluruh entitas sudah dilengkapi fitur **CRUD (*Create, Read, Update, Delete*)** secara penuh.

---

## ✨ Fitur & Relasi Entitas

| Entitas | Operasi yang Tersedia | Keterangan |
| :--- | :--- | :--- |
| **Lecturers** | Tambah, Lihat, Ubah, Hapus | Data induk dosen (termasuk atribut tambahan `email`) |
| **Courses** | Tambah, Lihat, Ubah, Hapus | Terhubung dengan tabel `lecturers` melalui *Foreign Key* |

### Skema Relasi Database
```text
LECTURERS (1) ────────< (Many) COURSES
```
* Satu dosen (*Lecturer*) dapat mengampu banyak mata kuliah (*Courses*).
* Pada form tambah dan ubah data **Courses**, pemilihan dosen pengampu menggunakan elemen `<select>` (*dropdown*) dinamis yang diambil dari tabel `lecturers`, sedangkan pada tabel utama langsung menampilkan **Nama Dosen** hasil *JOIN*.

---

## 📂 Susunan Direktori Project

```text
TP8DPBO2425C.../
├── Project/
│   ├── controllers/
│   │   ├── LecturerController.php
│   │   └── CourseController.php
│   │
│   ├── models/
│   │   ├── DB.php
│   │   ├── Lecturer.php
│   │   └── Course.php
│   │
│   ├── views/
│   │   ├── Template.php
│   │   ├── LecturerView.php
│   │   └── CourseView.php
│   │
│   ├── templates/
│   │   ├── lecturer.html
│   │   ├── lecturer_form.html
│   │   ├── course.html
│   │   └── course_form.html
│   │
│   ├── config.php
│   ├── index.php       <-- Entry Point halaman Lecturers
│   └── course.php      <-- Entry Point halaman Courses
│
├── Dokumentasi/
│   └── (File screenshot & screen record aplikasi)
│
├── tp_mvc25.sql
└── README.md
```

---

## 🏗️ Arsitektur & Alur Kerja MVC

Aplikasi memisahkan logika bisnis, akses database, dan tampilan antarmuka agar kode lebih terstruktur dan mudah dikembangkan:

```text
  [ User / Browser ]
         │  (1. HTTP Request: GET / POST)
         ▼
  [ Entry Point ]  (index.php / course.php)
         │  (2. Memanggil method aksi)
         ▼
  [ Controller ]   (LecturerController / CourseController)
    │         ▲
    │ (3)     │ (4) Data hasil query
    ▼         │
  [   Model    ]   (Lecturer / Course extends DB) ──► [ MySQL: tp_mvc25 ]
         │
         │  (5. Kirim data ke View)
         ▼
  [    View    ]   (LecturerView / CourseView + Template.php)
         │  (6. Render HTML dari folder templates/)
         ▼
  [ User / Browser ]
```

### Pembagian Tugas Komponen

1. **Models (`models/`)**  
   Bertanggung jawab atas komunikasi langsung ke database MySQL (`tp_mvc25`).
   * `DB.php`: *Parent class* yang menangani koneksi database (`open()`, `execute()`, `getResult()`, `close()`).
   * `Lecturer.php` & `Course.php`: *Child class* turunan `DB` yang mengeksekusi query `SELECT`, `INSERT`, `UPDATE`, dan `DELETE` (termasuk `JOIN` antara `courses` dan `lecturers`).

2. **Controllers (`controllers/`)**  
   Bertindak sebagai penghubung antara *request* pengguna, *Model*, dan *View*.
   * `LecturerController.php` & `CourseController.php`: Menangani alur logika seperti `index()`, `formAdd()`, `add()`, `formEdit()`, `edit()`, dan `delete()`, serta melakukan *redirect* setelah perubahan data.

3. **Views & Templates (`views/` & `templates/`)**  
   Memisahkan logika PHP dari struktur HTML murni.
   * `Template.php`: Mesin *templating* sederhana yang membaca file `.html` dan mengganti penanda (*placeholder*) `DATA_...` dengan data dinamis.
   * `LecturerView.php` & `CourseView.php`: Menyusun baris tabel HTML maupun opsi *dropdown* sebelum dirender ke layar.

---

## 🗄️ Struktur Database (`tp_mvc25.sql`)

<img width="475" height="200" alt="image" src="https://github.com/user-attachments/assets/9269b122-eea8-4cf2-b7db-93053bc305ab" />

Database **`tp_mvc25`** terdiri dari 2 tabel yang saling berelasi (*One-to-Many* dengan `ON DELETE CASCADE`):

### 1. Tabel `lecturers` (Tabel Induk)
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `INT (PK, AUTO_INCREMENT)` | Identitas unik dosen |
| `name` | `VARCHAR(100)` | Nama lengkap dan gelar dosen |
| `nidn` | `VARCHAR(50)` | Nomor Induk Dosen Nasional |
| `phone` | `VARCHAR(20)` | Nomor telepon aktif |
| `join_date` | `DATE` | Tanggal mulai bergabung |
| `email` | `VARCHAR(100)` | Alamat email dosen *(atribut tambahan)* |

### 2. Tabel `courses` (Tabel Relasi)
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `INT (PK, AUTO_INCREMENT)` | Identitas unik mata kuliah |
| `course_code` | `VARCHAR(20)` | Kode mata kuliah (contoh: `IK301`) |
| `course_name` | `VARCHAR(100)` | Nama mata kuliah |
| `credits` | `INT` | Jumlah beban SKS |
| `lecturer_id` | `INT (FK)` | Merujuk ke `lecturers(id)` |

---

## 🎥 Dokumentasi & Demo Program



https://github.com/user-attachments/assets/d2dea1f3-4c8c-4284-b356-0fb3a4fecde2


