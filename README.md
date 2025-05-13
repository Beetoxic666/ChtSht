Semangat ikut kompetisinya, Habel! 👍

Kalau kamu **tidak boleh pakai AI**, tapi **boleh melihat cheatsheet**, maka solusi terbaik adalah:

---

## ✅ **Solusi: Buat Cheatsheet Pribadi yang Ringkas & Padat**

### ✍️ Buat atau print **cheatsheet 1-2 halaman** yang berisi:

* Struktur umum PHP & MySQL (koneksi, query, pengambilan data)
* Fungsi umum (if, while, foreach)
* Query dasar SQL (SELECT, INSERT, UPDATE, JOIN)
* Contoh penggunaan `mysqli_fetch_assoc`, `$_POST`, dll

> **Tips:** Tulis dalam gaya kamu sendiri agar gampang diingat, bukan terlalu teknis seperti dokumentasi.

---

## ✅ **Solusi Tambahan: Hafalkan Struktur Umum Lewat Pola**

### Contoh pola umum yang harus kamu hafal:

#### 🔗 Koneksi:

```php
$conn = mysqli_connect("localhost", "root", "", "nama_db");
```

#### 🔎 SELECT + Fetch:

```php
$query = mysqli_query($conn, "SELECT * FROM tabel");
while($row = mysqli_fetch_assoc($query)) {
    echo $row['kolom'];
}
```

#### 📝 INSERT:

```php
mysqli_query($conn, "INSERT INTO tabel (kol1, kol2) VALUES ('$a', '$b')");
```

#### ✏️ UPDATE:

```php
mysqli_query($conn, "UPDATE tabel SET kol1='$a' WHERE id=$id");
```

---

## ✅ **Buat Template Reusable di Kertas atau Dokumen**

Buat satu template PHP seperti ini, lalu cetak:

```php
<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $a = $_POST['a'];
    mysqli_query($conn, "INSERT INTO ...");
}

$query = mysqli_query($conn, "SELECT * FROM ...");
while ($data = mysqli_fetch_assoc($query)) {
    echo $data['...'];
}
?>
```

---

## ✅ **Gunakan Warna atau Kotak Kecil**

Bikin bagian-bagian dengan kotak kecil agar mudah dilihat saat butuh cepat:

🟩 **Koneksi**
🟨 **Query SELECT**
🟦 **INSERT**
🟥 **UPDATE**
🟪 **Loop data (while / foreach)**

---

## ✅ **Gunakan Singkatan Sendiri**

Contoh:

* `SFX` = SELECT + fetch
* `INS` = INSERT
* `CONN` = koneksi
* `FLOOP` = while/fetch loop

Gunakan di cheatsheet kamu agar hemat ruang & mudah dibaca saat panik.

---

## ✅ **Bonus: Belajar Aktif**

Sebelum kompetisi, coba:

* Tulis ulang kode dari nol tanpa melihat (latihan memori otot)
* Kerjakan soal dari tahun lalu atau simulasi sendiri

---

Kalau kamu mau, aku bisa bantu **desain dan buat cheatsheet PDF A4** yang bisa kamu cetak dan bawa ke kompetisi. Mau aku bantu buatkan?
