<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM</h1>
  <h2>APLIKASI BERBASIS PLATFORM</h2>
  <br />
  <h3>Flutter Modul5&6</h3>
  <h3> FONT & TEXTFIELD</h3>
  <br />
  <br />
  <img src="logo.JPEG" alt="Logo Universitas Telkom Purwokerto" width="280">
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>AVRIZAL SETYO AJI NUGROHO</strong><br>
    <strong>2311102145</strong><br>
    <strong>S1 IF-11-REG01</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <h4>Asisten Praktikum :</h4>
  <p>
    <strong>Apri Pandu Wicaksono</strong><br>
    <strong>Rangga Pradarrell Fathi</strong>
  </p>
  <br />
  <h3>
    LABORATORIUM HIGH PERFORMANCE<br>
    FAKULTAS INFORMATIKA<br>
    UNIVERSITAS TELKOM PURWOKERTO<br>
    2026
  </h3>
</div>

---

## 1. Dasar Teori

### Komponen Utama dalam Pengembangan UI Flutter

Dalam membangun antarmuka pengguna (UI) menggunakan Flutter, terdapat beberapa komponen (*widget*) dasar yang memiliki peran penting:

* **`Scaffold`** Merupakan fondasi atau cetak biru visual utama untuk menerapkan desain berbasis *Material Design*. Komponen ini berfungsi sebagai wadah besar yang memudahkan pengaturan elemen-elemen halaman, seperti area konten utama (`body`), bilah navigasi atas (`appBar`), hingga tombol melayang (`floatingActionButton`).

* **`Column`** Sebuah *widget* tata letak (*layout*) yang bersifat fleksibel untuk menyusun berbagai elemen di dalamnya secara vertikal, berjejer dari atas ke bawah.

* **`Padding`** *Widget* yang berfungsi untuk menyisipkan ruang atau jarak kosong di sekeliling komponen yang dibungkusnya. Penerapan *padding* ini menjaga agar elemen-elemen antarmuka tetap proporsional dan tidak saling menempel satu sama lain.

* **`TextField`** Komponen interaktif yang menyediakan kolom pengisian bagi pengguna untuk mengetikkan teks melalui papan ketik (*keyboard*). Tampilannya dapat dikustomisasi lebih lanjut menggunakan properti `decoration` (seperti `InputDecoration`) untuk menyisipkan teks petunjuk (*placeholder/hint*) serta mengatur gaya bingkai (*border*).

---

## 2. Penjelasan Kode

### 2.1 container

```dart
import 'package:flutter/material.dart';

//2311102145- Avrizal Setyo Aji Nugroho
void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Talkyu',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: Colors.orange,
          primary: Colors.orange,
        ),
        useMaterial3: true,
      ),
      home: const MyHomePage(title: 'Talkyu'),
      debugShowCheckedModeBanner: false,
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key, required this.title});

  final String title;

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          widget.title,
          style: const TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
        backgroundColor: Colors.orange,
        centerTitle: true,
      ),
      body: SafeArea(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.end,
          children: const <Widget>[
            Padding(
              padding: EdgeInsets.symmetric(horizontal: 12, vertical: 8),
              child: TextField(
                decoration: InputDecoration(
                  labelText: "Masukin nama para SUKI liar",
                  border: OutlineInputBorder(),
                ),
              ),
            ),
            Padding(
              padding: EdgeInsets.symmetric(horizontal: 12, vertical: 8),
              child: TextField(
                decoration: InputDecoration(
                  labelText: "Nama jenderal ngawi",
                  border: OutlineInputBorder(),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

```
penjelasan
* **`main()` & `runApp()`**: Titik awal untuk menjalankan dan meluncurkan aplikasi Flutter.
* **`MyApp` (`StatelessWidget`)**: Mengatur konfigurasi dasar aplikasi, seperti mematikan banner debug dan menyetel tema warna utama menjadi Orange.
* **`MyHomePage` (`StatefulWidget`)**: Halaman utama aplikasi yang bersifat dinamis (tampilannya bisa berubah jika ada interaksi data).
* **`Scaffold`**: Struktur dasar halaman yang menyediakan tempat untuk membuat AppBar dan area isi (`body`).
* **`AppBar`**: Bar navigasi atas berwarna orange dengan teks judul "Talkyu" di posisi tengah.
* **`SafeArea`**: Menjaga agar konten aplikasi tidak terpotong oleh poni (*notch*) atau status bar ponsel.
* **`Column`**: Menyusun elemen di dalamnya secara vertikal (ke bawah) dan merapat ke kanan (`crossAxisAlignment.end`).
* **`Padding` & `TextField`**: Dua buah kotak input teks ("Masukin nama para SUKI liar" dan "Nama jenderal ngawi") yang diberi jarak pembatas agar terlihat rapi dengan bingkai kotak (`OutlineInputBorder`).

---

## 3. Screenshot Hasil

![Screenshot Hello World](hasil.png)

---

## 4. Referensi

- Dart: [https://dart.dev](https://dart.dev)
- Flutter Docs: [https://docs.flutter.dev](https://docs.flutter.dev)
