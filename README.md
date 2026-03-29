<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>TUGAS 2 PRAKTIKUM<br>SISTEM DATA MAHASISWA (CRUD)</h3>
  <br />
  <p align="center">
    <img src="logo.jpeg" width="200">
  </p>
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Avrizal Setyo Aji Nugroho</strong><br>
    <strong>2311102145</strong><br>
    <strong>S1 IF-11-01</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p><strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong></p>
  <br />
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono </strong> <br>
  <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

<hr>

### 1. Deskripsi Teknologi

Aplikasi ini merupakan sistem manajemen data mahasiswa sederhana yang dibangun untuk memenuhi kriteria Tugas 2 Praktikum. Teknologi yang digunakan meliputi:

- **Node.js & Express.js**: Server-side runtime dan framework untuk menangani routing dan logika CRUD.
- **EJS (Embedded JavaScript)**: Template engine untuk menghasilkan halaman HTML dinamis.
- **Bootstrap 5**: Framework CSS untuk tampilan responsif dengan tema **Dark Mode**.
- **jQuery & DataTables**: Plugin untuk penyajian tabel interaktif menggunakan format **JSON**.

### 2. Arsitektur Direktori Proyek

```text
TUGAS 2 PRAKTIKUM/
├── node_modules/         # Folder dependencies (Express, EJS, dll)
├── views/                # Folder template tampilan aplikasi (EJS)
│   ├── index.ejs         # Halaman Tabel (DataTables & JSON API)
│   ├── tambah.ejs        # Form Input Mahasiswa baru
│   └── edit.ejs          # Form Pembaruan Data Mahasiswa
├── app.js                # Server Utama (Routing & Logika CRUD)
├── package.json          # Manifest proyek & daftar library
└── README.md             # Dokumentasi Laporan Praktikum
```

### 3. Implementasi Kode Program

#### A. File `app.js` (Server & API JSON)

File ini mengelola simulasi database menggunakan array in-memory dan menyediakan endpoint API JSON.

```javascript
const express = require("express");
const app = express();
const bodyParser = require("body-parser");

app.set("view engine", "ejs");
app.use(bodyParser.urlencoded({ extended: true }));

// Data dummy sementara
let dataMahasiswa = [
  {
    id: 1,
    nama: "Avrizal Setyo Aji Nugroho",
    nim: "2311102145",
    kelas: "APLIKASI BERBASIS PLATFORM PS1IF-11-REG01",
  },
];

// Halaman Utama: Tabel Data
app.get("/", (req, res) => res.render("index"));

// Halaman Form: Input Data
app.get("/tambah", (req, res) => res.render("tambah"));

// Endpoint JSON: Wajib untuk DataTables
app.get("/api/data", (req, res) => res.json({ data: dataMahasiswa }));

// Proses Simpan Data (Create)
// Halaman Tambah
app.get("/tambah", (req, res) => {
  res.render("tambah"); // Render file tambah.ejs
});

// Halaman Edit (Ambil data dulu)
app.get("/edit/:id", (req, res) => {
  const data = dataMahasiswa.find((d) => d.id == req.params.id);
  res.render("edit", { data: data }); // Render file edit.ejs
});

// Route Simpan (Untuk Tambah)
app.post("/simpan", (req, res) => {
  const { nama, nim, kelas } = req.body;
  dataMahasiswa.push({ id: Date.now(), nama, nim, kelas });
  res.redirect("/");
});

// Route Update (Untuk Edit)
app.post("/update", (req, res) => {
  const { id, nama, nim, kelas } = req.body;
  const index = dataMahasiswa.findIndex((d) => d.id == id);
  dataMahasiswa[index] = { id: parseInt(id), nama, nim, kelas };
  res.redirect("/");
});

// Proses Hapus (Delete)
app.get("/hapus/:id", (req, res) => {
  dataMahasiswa = dataMahasiswa.filter((d) => d.id != req.params.id);
  res.redirect("/");
});

app.listen(3000, () =>
  console.log("Tugas 2 berjalan di http://localhost:3000"),
);
```

# Penjelasan Baris Kode `app.js`

- **Baris 1–3**: Mengimpor modul `express` untuk framework web dan `body-parser` untuk memproses data dari form HTML.

- **Baris 5–6**: Menetapkan EJS sebagai template engine dan mengaktifkan middleware untuk membaca data URL-encoded dari permintaan POST.

- **Baris 9–11**: Inisialisasi variabel `dataMahasiswa` sebagai penyimpanan data sementara di memori server (Array In-Memory).

- **Baris 14–17**: Mendefinisikan rute GET untuk menampilkan halaman utama (`index`) dan halaman formulir tambah data (`tambah`).

- **Baris 20**: Membuat endpoint API `/api/data` yang mengirimkan data mahasiswa dalam format JSON untuk kebutuhan jQuery DataTables.

- **Baris 23–31**: Menangani logika Edit; mencari data mahasiswa berdasarkan parameter ID dan mengirimkannya ke view `edit.ejs`.

- **Baris 34–39**: Menangani proses Simpan; mengekstrak data dari body request, memberikan ID unik via `Date.now()`, lalu menambahkannya ke array.

- **Baris 42–47**: Menangani proses Update; memperbarui record mahasiswa pada indeks array yang sesuai berdasarkan ID yang dikirimkan.

- **Baris 50–53**: Menangani proses Hapus; menyaring array untuk membuang data yang ID-nya cocok dengan parameter URL.

- **Baris 55–57**: Menjalankan server pada port 3000 dan menampilkan pesan konfirmasi di terminal.

#### B. File `views/index.ejs` (Halaman Tabel Utama)

[cite_start]Halaman ini mengintegrasikan plugin jQuery DataTables untuk menampilkan data dari server[cite: 11].

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <title>Tugas COTS 2 - Data Mahasiswa</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"
    />

    <style>
      .dataTables_length select {
        background-color: #ffffff !important;
      }
      .dataTables_filter input {
        background-color: #ffffff !important;
      }
    </style>
  </head>

  <body class="bg-dark text-light">
    <div class="container mt-5">
      <div class="card shadow bg-dark text-white border-0">
        <div class="card-header bg-black text-white p-3">
          <h3 class="mb-0 text-center fw-bold">
            Tugas COTS 2: Daftar Mahasiswa
          </h3>
        </div>
        <div class="card-body">
          <a href="/tambah" class="btn btn-success fw-bold mb-3"
            >+ Tambah Data</a
          >

          <table
            id="tabelTugas"
            class="table table-light table-striped table-hover table-bordered border-dark"
          >
            <thead>
              <tr class="table-active">
                <th>Nama</th>
                <th>NIM</th>
                <th>Kelas</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <p class="text-center text-white-50 mt-3">
        <small
          >&copy; 2026 Tugas COTS 2 Praktikum - Avrizal Setyo Aji Nugroho</small
        >
      </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#tabelTugas").DataTable({
          ajax: "/api/data",
          columns: [
            { data: "nama" },
            { data: "nim" },
            { data: "kelas" },
            // Di dalam script DataTable, bagian columns:
            {
              data: "id",
              render: function (data) {
                return `
                            <a href="/edit/${data}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/hapus/${data}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        `;
              },
            },
          ],
        });
      });
    </script>
  </body>
</html>
```

# Penjelasan Baris Kode `index.ejs`

- **Baris 1–7**: Inisialisasi dokumen HTML dan pemanggilan CDN untuk Bootstrap 5 dan jQuery DataTables guna keperluan styling dan fungsionalitas tabel.
- **Baris 9–16**: Blok CSS khusus untuk mengubah warna latar belakang kotak pencarian dan dropdown jumlah entri menjadi putih agar kontras dengan tema gelap aplikasi.
- **Baris 18–24**: Struktur pembungkus utama menggunakan komponen card Bootstrap dengan latar belakang gelap (bg-dark) dan judul yang dipusatkan.
- **Baris 26**: Tombol navigasi yang mengarahkan pengguna ke halaman rute `/tambah` untuk menginput data baru.
- **Baris 28–38**: Definisi struktur tabel HTML dengan ID `tabelTugas` dan baris header yang mencakup kolom Nama, NIM, Kelas, dan Aksi.
- **Baris 40**: Bagian kaki halaman (footer) yang menampilkan informasi hak cipta dan identitas mahasiswa dengan teks berwarna putih pudar (`text-white-50`).
- **Baris 43–44**: Pemanggilan library jQuery dan plugin DataTables melalui CDN sebagai prasyarat menjalankan fitur tabel interaktif.
- **Baris 45–47**: Inisialisasi plugin DataTables pada elemen tabel dengan ID `tabelTugas` segera setelah dokumen siap dimuat.
- **Baris 48**: Mengonfigurasi DataTables untuk mengambil data secara otomatis (asynchronous) dari endpoint API rute `/api/data` dalam format JSON.
- **Baris 49–52**: Memetakan properti JSON (`nama`, `nim`, `kelas`) ke dalam kolom-kolom tabel yang bersesuaian.
- **Baris 54–61**: Menggunakan fungsi `render` pada kolom ID untuk membuat tombol aksi Edit dan Hapus secara dinamis, lengkap dengan dialog konfirmasi sebelum penghapusan data.

#### C. File `views/tambah.ejs` (Halaman Input)

[cite_start]Halaman formulir untuk registrasi data mahasiswa baru[cite: 23].

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tugas COTS 2 - Tambah Data</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>

  <body class="bg-dark text-light">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow bg-secondary text-white border-0">
            <div class="card-header bg-black text-white p-3">
              <h4 class="mb-0 text-center fw-bold">Tambah Data Mahasiswa</h4>
            </div>
            <div class="card-body p-4">
              <form action="/simpan" method="POST">
                <div class="mb-3">
                  <label class="form-label fw-bold">Nama Lengkap</label>
                  <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Contoh: Avrizal Setyo"
                    required
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">NIM</label>
                  <input
                    type="text"
                    name="nim"
                    class="form-control"
                    placeholder="Masukkan NIM Anda"
                    required
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Kelas</label>
                  <input
                    type="text"
                    name="kelas"
                    class="form-control"
                    placeholder="Contoh: APLIKASI BERBASIS PLATFORM PS1IF-11-REG01"
                    required
                  />
                </div>

                <div class="d-grid gap-2 mt-4">
                  <button type="submit" class="btn btn-success fw-bold">
                    Simpan Data
                  </button>
                  <a href="/" class="btn btn-outline-light">Batal / Kembali</a>
                </div>
              </form>
            </div>
          </div>
          <p class="text-center text-white mt-3">
            <small
              >&copy; 2026 Tugas COTS 2 Praktikum - Avrizal Setyo Aji
              Nugroho</small
            >
          </p>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
```

# Penjelasan Baris Kode `tambah.ejs`

- **Baris 1–8**: Pendefinisian struktur dasar HTML5 dan pemanggilan CSS Bootstrap 5 untuk mengatur tata letak dan desain formulir.

- **Baris 10–14**: Pengaturan body dengan tema gelap (`bg-dark`) dan penggunaan sistem grid Bootstrap untuk memposisikan formulir tepat di tengah halaman.

- **Baris 15–18**: Pembuatan komponen card dengan latar belakang abu-abu (`bg-secondary`) serta bagian header berwarna hitam yang berisi judul formulir.

- **Baris 19–20**: Pembukaan tag `<form>` dengan atribut `method="POST"` yang mengarahkan data ke rute `/simpan` pada server Node.js saat tombol diklik.

- **Baris 21–24**: Input teks untuk Nama Lengkap yang dilengkapi dengan atribut `name="nama"` sebagai kunci identitas data saat dikirim ke backend.

- **Baris 26–29**: Input teks untuk NIM menggunakan atribut `required` guna memastikan pengguna tidak mengosongkan kolom ini sebelum mengirim data.

- **Baris 31–34**: Input teks untuk Kelas yang memberikan contoh format penulisan kelas melalui atribut `placeholder`.

- **Baris 36–39**: Bagian aksi formulir yang berisi tombol Simpan Data (Submit) dan tombol Batal yang berfungsi sebagai tautan kembali ke halaman utama (`/`).

- **Baris 43**: Penulisan informasi hak cipta dan identitas pengembang di bagian bawah kartu formulir.

- **Baris 47**: Pemanggilan skrip JavaScript Bootstrap untuk mendukung interaksi komponen UI jika diperlukan.

#### D. File `views/edit.ejs` (Halaman Perbaruan)

[cite_start]Halaman formulir untuk memperbarui data mahasiswa berdasarkan ID[cite: 1].

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tugas COTS 2 - Edit Data</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>

  <body class="bg-dark text-light">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow bg-secondary text-white border-0">
            <div class="card-header bg-black text-white p-3">
              <h4 class="mb-0 text-center fw-bold">Edit Data Mahasiswa</h4>
            </div>
            <div class="card-body p-4">
              <form action="/update" method="POST">
                <input type="hidden" name="id" value="<%= data.id %>" />

                <div class="mb-3">
                  <label class="form-label fw-bold">Nama Lengkap</label>
                  <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="<%= data.nama %>"
                    required
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">NIM</label>
                  <input
                    type="text"
                    name="nim"
                    class="form-control"
                    value="<%= data.nim %>"
                    required
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Kelas</label>
                  <input
                    type="text"
                    name="kelas"
                    class="form-control"
                    value="<%= data.kelas %>"
                    required
                  />
                </div>

                <div class="d-grid gap-2 mt-4">
                  <button type="submit" class="btn btn-warning fw-bold">
                    Update Data
                  </button>
                  <a href="/" class="btn btn-outline-light">Batal / Kembali</a>
                </div>
              </form>
            </div>
          </div>
          <p class="text-center text-white mt-3">
            <small
              >&copy; 2026 Tugas COTS 2 Praktikum - Avrizal Setyo Aji
              Nugroho</small
            >
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
```

# Penjelasan Baris Kode `edit.ejs`

- **Baris 1–7**: Inisialisasi struktur dokumen HTML5 dan pemanggilan CSS Bootstrap 5 melalui CDN untuk keperluan tata letak halaman.

- **Baris 9–17**: Konfigurasi tampilan dengan tema gelap (`bg-dark`) dan pembuatan kartu (card) sebagai kontainer utama formulir edit.

- **Baris 18–19**: Pembukaan tag `<form>` dengan metode POST yang diarahkan ke rute `/update` di server untuk memproses perubahan data.

- **Baris 20**: Penggunaan input `type="hidden"` untuk mengirimkan ID mahasiswa ke server secara diam-diam agar server mengetahui data mana yang harus diperbarui.

- **Baris 22–25**: Blok input untuk Nama Lengkap yang nilainya diisi otomatis menggunakan tag EJS `<%= data.nama %>`.

- **Baris 27–30**: Blok input untuk NIM yang menampilkan nilai lama mahasiswa agar dapat langsung diperbaiki tanpa mengetik ulang.

- **Baris 32–35**: Blok input untuk Kelas yang juga menggunakan auto-fill EJS untuk menampilkan data kelas mahasiswa.

- **Baris 37–40**: Penyediaan tombol Update Data (`btn-warning`) dan tombol Batal untuk kembali ke halaman utama.

- **Baris 44–45**: Elemen teks di bawah formulir yang menampilkan informasi hak cipta dan identitas mahasiswa.

### 4. Hasil Program (Screenshot Output)

#### 1. Tampilan Awal Halaman

![Tampilan Awal Web](Tampilan1.png)

#### 2. Input Data & Data Berhasil Ditambahkan

![Form Input Data](Tampilantambah1.png)
![Data Berhasil Ditambahkan](Tampilantambah2.png)

#### 3. Edit Data

Mengedit Ferguso ke Ferguso Smit
![Edit Data ](tampilanedit1.png)
![Edit Data ](edit2.png)
![Edit Data ](edit3.png)
![Edit Data ](hasiledit.png)

#### 4. Hapus Data

Menghapus ferguso smit
![Hapus Data ](hapus.png)
![Hapus Data ](hasilhapus.png)

#### 5. Fitur Pencarian (Search)

![Fitur Searching](search.png)

### 5. Link Video Presentasi

_(Tambahkan Tautan Video Anda di Sini)_

```

---

Selesai! Laporan ini sudah mencakup **seluruh file** yang kamu punya. Sekarang kamu tinggal fokus ke tahap akhir:
1.  Ambil *screenshot* aplikasi.
2.  Rekam video presentasi di **Acer Nitro 5** kamu.
3.  Kumpulkan tepat waktu besok!

Ada bagian kode lain yang mau dimasukkan ke laporan ini?
```
