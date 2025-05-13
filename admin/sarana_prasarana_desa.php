<?php 
    include "../configDB.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["aksi"])) {
            $aksi = $_POST["aksi"];
            $id = $_POST["id"] ?? null;
            $nama_sarana = $_POST["nama_sarana"];
            $kegunaan = $_POST["kegunaan"];
            $kembali = $_POST["kembali"];

            if ($aksi == "tambah") {
                $query = "INSERT INTO sarana_prasarana (nama_sarana, kegunaan, kembali) VALUES ('$nama_sarana', '$kegunaan', '$kembali')";
            } elseif ($aksi == "edit" && $id) {
                $query = "UPDATE sarana_prasarana SET nama_sarana='$nama_sarana', kegunaan='$kegunaan', kembali='$kembali' WHERE id='$id'";
            } elseif ($aksi == "hapus" && $id) {
                $query = "DELETE FROM sarana_prasarana WHERE id='$id'";
            }

            if (isset($query)) {
                $result = mysqli_query($conn, $query);
                header("Location: sarana_prasarana_desa.php?page=sarana_prasarana_desa");
                exit;
            }
        }
    }
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
    <div class="sidebar"><?php include "../components/admin/sidebar.php"?></div>
    <div class="content">
        <?php include "../components/admin/navbar.php"?>
        <h1>Data Sarana dan Prasarana Desa</h1>
        <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Data
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th><button class="fw-bold p-0 btn">No</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="nama_sarana">Nama Sarana dan Prasarana</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="tanggal_kegunaan">Tanggal Kegunaan</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="tanggal_kembali">Tanggal Kembali</button></th>
                    <th><button class="fw-bold p-0 btn no-print">Action</button></th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM sarana_prasarana";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr class="table-row">
                            <td><?= $no?></td>
                            <td class="search-target"><?= $row["nama_sarana"]?></td>
                            <td><?= $row["kegunaan"]?></td>
                            <td><?= $row["kembali"]?></td>
                            <td>
                                <!-- Tombol Trigger Modal Edit -->
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>">Edit</button>
                                <!-- Tombol Trigger Modal Delete -->
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['id'] ?>">Delete</button>

                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $row['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form method="POST">
                                    <input type="hidden" name="aksi" value="edit">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel<?= $row['id'] ?>">Edit Sarana Prasarana</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Sarana</label>
                                        <input type="text" class="form-control" name="nama_sarana" value="<?= $row['nama_sarana'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <input type="date" class="form-control" name="kegunaan" value="<?= $row['kegunaan'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label>
                                        <input type="date" class="form-control" name="kembali" value="<?= $row['kembali'] ?>" required>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Delete -->
                        <div class="modal fade" id="modalDelete<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modalDeleteLabel<?= $row['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form method="POST">
                                    <input type="hidden" name="aksi" value="hapus">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteLabel<?= $row['id'] ?>">Hapus Sarana Prasarana</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                    <p>Apakah kamu yakin ingin menghapus <strong><?= $row['nama_sarana'] ?></strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
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
                <h5 class="modal-title" id="modalTambahLabel">Tambah Sarana Prasarana</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_sarana" class="form-label">Nama Sarana Prasarana</label>
                    <input type="text" class="form-control" id="nama_sarana" name="nama_sarana" required>
                </div>
                <div class="mb-3">
                    <label for="kegunaan" class="form-label">Tanggal Kegunaan</label>
                    <input type="date" class="form-control" id="kegunaan" name="kegunaan" required>
                </div>
                <div class="mb-3">
                    <label for="kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" class="form-control" id="kembali" name="kembali" required>
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
            if (key === 'nama_sarana') return 1;
            if (key === 'tanggal_kegunaan') return 2;
            if (key === 'tanggal_kembali') return 3;
            return 1;
        }
    </script>

</body>
</html>