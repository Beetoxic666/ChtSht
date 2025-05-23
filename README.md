CheatSheet:

---

## 🗃️ **1. SELECT (Mengambil Data)**

```sql
SELECT * FROM nama_tabel;                       -- Semua kolom
SELECT kolom1, kolom2 FROM nama_tabel;          -- Kolom tertentu
```

### 🔍 Dengan kondisi:

```sql
SELECT * FROM penduduk WHERE jenis_kelamin = 'Laki-Laki';
```

---

## 🧮 **2. Fungsi Agregat**

| Fungsi       | Deskripsi                 | Contoh                                   |
| ------------ | ------------------------- | ---------------------------------------- |
| `COUNT(*)`   | Hitung jumlah baris       | `SELECT COUNT(*) FROM penduduk;`         |
| `SUM(kolom)` | Jumlahkan isi kolom angka | `SELECT SUM(jumlah_jiwa) FROM penduduk;` |
| `AVG(kolom)` | Rata-rata                 | `SELECT AVG(usia) FROM penduduk;`        |
| `MAX(kolom)` | Nilai maksimum            | `SELECT MAX(usia) FROM penduduk;`        |
| `MIN(kolom)` | Nilai minimum             | `SELECT MIN(usia) FROM penduduk;`        |

---

## 📊 **3. GROUP BY (Pengelompokan Data)**

```sql
SELECT jenis_kelamin, COUNT(*) AS total
FROM penduduk
GROUP BY jenis_kelamin;
```

```sql
SELECT rt, SUM(jumlah_jiwa) AS total_jiwa
FROM penduduk
GROUP BY rt;
```

---

## 🔃 **4. JOIN (Menggabungkan Tabel)**

```sql
-- INNER JOIN: hanya data yang cocok di kedua tabel
SELECT a.nama, b.nama_kecamatan
FROM penduduk a
INNER JOIN kecamatan b ON a.id_kecamatan = b.id;

-- LEFT JOIN: semua dari kiri + cocok dari kanan
SELECT a.nama, b.nama_kecamatan
FROM penduduk a
LEFT JOIN kecamatan b ON a.id_kecamatan = b.id;

-- RIGHT JOIN: semua dari kanan + cocok dari kiri
SELECT a.nama, b.nama_kecamatan
FROM penduduk a
RIGHT JOIN kecamatan b ON a.id_kecamatan = b.id;
```

---

## 🔄 **5. INSERT (Menambah Data)**

```sql
INSERT INTO penduduk (nama, jenis_kelamin, rt) 
VALUES ('Budi', 'Laki-Laki', 'RT 01');
```

---

## ✏️ **6. UPDATE (Mengubah Data)**

```sql
UPDATE penduduk 
SET rt = 'RT 02' 
WHERE nama = 'Budi';
```

---

## ❌ **7. DELETE (Menghapus Data)**

```sql
DELETE FROM penduduk 
WHERE nama = 'Budi';
```

---

## 🧠 **8. WHERE + AND/OR + LIKE**

```sql
-- Dengan AND
SELECT * FROM penduduk 
WHERE jenis_kelamin = 'Laki-Laki' AND rt = 'RT 01';

-- Dengan OR
SELECT * FROM penduduk 
WHERE rt = 'RT 01' OR rt = 'RT 02';

-- LIKE (pencarian mirip)
SELECT * FROM penduduk 
WHERE nama LIKE 'Bud%';   -- nama dimulai "Bud"
```

---

## 🔢 **9. DISTINCT (Mengambil Nilai Unik)**

```sql
SELECT DISTINCT rt FROM penduduk;
```

---

## 📌 **10. ORDER BY (Pengurutan)**

```sql
SELECT * FROM penduduk 
ORDER BY nama ASC;       -- A-Z
ORDER BY usia DESC;      -- terbesar ke kecil
```

---

## 📄 **11. LIMIT (Membatasi Data Keluar)**

```sql
SELECT * FROM penduduk 
LIMIT 10;                -- ambil 10 baris pertama
```

---

## 🔀 **12. CASE (Kondisi di dalam SELECT)**

```sql
SELECT nama,
  CASE 
    WHEN jenis_kelamin = 'Laki-Laki' THEN 'Pria'
    WHEN jenis_kelamin = 'Perempuan' THEN 'Wanita'
    ELSE 'Tidak diketahui'
  END AS jenis
FROM penduduk;
```

---

## 📦 **13. SUBQUERY (Query di dalam Query)**

```sql
SELECT * FROM penduduk 
WHERE usia = (SELECT MAX(usia) FROM penduduk);
```

---

## 🧾 **14. CREATE TABLE (Membuat Tabel)**

```sql
CREATE TABLE penduduk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin ENUM('Laki-Laki', 'Perempuan'),
    rt VARCHAR(10),
    jumlah_jiwa INT
);
```

---

## 🔐 **15. ALTER TABLE (Ubah Struktur Tabel)**

```sql
ALTER TABLE penduduk ADD COLUMN usia INT;
ALTER TABLE penduduk MODIFY COLUMN rt VARCHAR(5);
ALTER TABLE penduduk DROP COLUMN usia;
```

---

## 🔎 **16. Fungsi Lain yang Sering Dipakai**

```sql
-- Menggabungkan string
SELECT CONCAT(nama_depan, ' ', nama_belakang) AS nama_lengkap FROM pengguna;

-- UPPER & LOWER
SELECT UPPER(nama), LOWER(nama) FROM penduduk;

-- Mengambil panjang teks
SELECT LENGTH(nama) FROM penduduk;
```

---
