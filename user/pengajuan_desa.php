<?php include "../configDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["aksi"])) {
        $aksi = $_POST["aksi"];
        $id = $_POST["id"] ?? null;
        $subjek = $_POST["subjek"];
        $deskripsi = $_POST["deskripsi"];
        $untuk = $_POST["untuk"];
        $tanggal_dibuat = $_POST["tanggal_dibuat"];

        if ($aksi == "tambah") {
            $query = "INSERT INTO pengajuan (subjek, deskripsi, untuk, tanggal_dibuat) VALUES ('$subjek', '$deskripsi', '$untuk', '$tanggal_dibuat')";
        }

        if (isset($query)) {
            $result = mysqli_query($conn, $query);
            header("Location: pengajuan_desa.php?page=pengajuan_desa");
            exit;
        }
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Desa Rimba Beringin</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .cont-card {
            display: flex;
            gap: 50px;
        }
        .card {
            display: flex;
            flex-direction: column;
            padding:10px;
            width: 200px;
            border-radius: 12px;
        }
        .card:nth-child(1) {
            background-color: blue;
            color: white;
        }
        .card:nth-child(2) {
            background-color: green;
            color: white;
        }
        .card > .info-detail {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            border-top: 1px solid white;
            padding: 10px 0 0 0;
        }
        .card > .info-detail > a {
            text-decoration: none;
            color: white;
        }

        .cont-image {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar"><?php include "../components/user/sidebar.php"?></div>
    <div class="content">
        <?php include "../components/user/navbar.php"?>
        <h1>Data Pengajuan Desa</h1>
        <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Data
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th><button class="fw-bold p-0 btn">No</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="subject">Subject</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="deskripsi">Deskripsi</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="tanggal_dibuat">Tanggal Dibuat</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="to">To</button></th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM pengajuan";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr class="table-row">
                            <td><?= $no?></td>
                            <td class="search-target"><?= $row["subjek"]?></td>
                            <td class="search-target"><?= $row["deskripsi"]?></td>
                            <td><?= $row["tanggal_dibuat"]?></td>
                            <td class="search-target"><?= $row["untuk"]?></td>
                        </tr>
                    <?php
                    $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Form Tambah Data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="POST">
                <input type="hidden" name="aksi" value="tambah">
                <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="subjek" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subjek" name="subjek" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal_dibuat" class="form-label">Tanggal Dibuat</label>
                    <input type="date"  class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" required>
                </div>
                <div class="mb-3">
                    <label for="untuk" class="form-label">To</label>
                    <input type="text" class="form-control" id="untuk" name="untuk" required>
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tableBody .table-row');

            rows.forEach(row => {
                // Ambil semua elemen dengan class "search-target" dalam baris ini
                const targets = row.querySelectorAll('.search-target');
                let combinedText = '';

                // Gabungkan semua teks dari elemen-elemen target
                targets.forEach(el => {
                    combinedText += el.textContent.toLowerCase() + ' ';
                });

                // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
                row.style.display = combinedText.includes(keyword) ? '' : 'none';
            });
        });

        let currentSort = { key: '', asc: true };

        document.querySelectorAll('.sort-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const key = btn.dataset.key;
                const asc = currentSort.key === key ? !currentSort.asc : true;
                currentSort = { key, asc };

                const rows = Array.from(document.querySelectorAll('#tableBody .table-row'));
                rows.sort((a, b) => {
                    const aText = a.querySelector(`td:nth-child(${getColumnIndex(key)})`).textContent.trim().toLowerCase();
                    const bText = b.querySelector(`td:nth-child(${getColumnIndex(key)})`).textContent.trim().toLowerCase();

                    if (aText < bText) return asc ? -1 : 1;
                    if (aText > bText) return asc ? 1 : -1;
                    return 0;
                });

                const tbody = document.getElementById('tableBody');
                rows.forEach(row => tbody.appendChild(row));
            });
        });

        function getColumnIndex(key) {
            if (key === 'subject') return 1;
            if (key === 'deskripsi') return 2;
            if (key === 'tanggal_dibuat') return 3;
            if (key === 'to') return 4;
            return 1;
        }
    </script>

</body>
</html>