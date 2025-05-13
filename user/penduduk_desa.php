<?php 
    include "../configDB.php";
    $query = mysqli_query($conn, "SELECT 
                COUNT(*) AS total_penduduk,
                SUM(CASE WHEN jenis_kelamin = 'Laki-Laki' THEN 1 ELSE 0 END) AS total_lakilaki, 
                SUM(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) AS total_perempuan ,
                COUNT(DISTINCT rt) AS total_rt
                FROM penduduk");
    $data = mysqli_fetch_assoc($query);
    $jumlah_penduduk = $data['total_penduduk'];
    $jumlah_lakilaki = $data['total_lakilaki'];
    $jumlah_perempuan = $data['total_perempuan'];
    $jumlah_rt = $data['total_rt'];
?>
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
        <h1>Data Penduduk Desa</h1>

        <div class="d-flex items-center gap-3 mb-3">
            <div class="border rounded shadow py-3" style="width: 250px;">
                <h3 class="text-center"><?= $jumlah_penduduk ?></h3>
                <p class="text-center">Jumlah Jiwa</p>
            </div>
            <div class="border rounded shadow py-3" style="width: 250px;">
                <h3 class="text-center"><?= $jumlah_lakilaki ?></h3>
                <p class="text-center">Jumlah Laki Laki</p>
            </div>
            <div class="border rounded shadow py-3" style="width: 250px;">
                <h3 class="text-center"><?= $jumlah_perempuan ?></h3>
                <p class="text-center">Jumlah Perempuan</p>
            </div>
            <div class="border rounded shadow py-3" style="width: 250px;">
                <h3 class="text-center"><?= $jumlah_rt ?></h3>
                <p class="text-center">Jumlah RT</p>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th><button class="fw-bold p-0 btn">No</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="nama_penduduk">Nama Penduduk</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="rt">RT</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="jenis_kelamin">Jenis Kelamin</button></th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM penduduk";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr class="table-row">
                            <td><?= $no?></td>
                            <td class="search-target"><?= $row["nama"]?></td>
                            <td><?= $row["rt"]?></td>
                            <td><?= $row["jenis_kelamin"]?></td>
                        </tr>
                    <?php
                    $no++;
                    }
                ?>
            </tbody>
        </table>
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
            if (key === 'nama_penduduk') return 1;
            if (key === 'rt') return 2;
            if (key === 'jenis_kelamin') return 3;
            return 1;
        }
    </script>

</body>
</html>