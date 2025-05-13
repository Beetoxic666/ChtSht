<?php 
    include "../configDB.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["aksi"])) {
            $aksi = $_POST["aksi"];
            $id = $_POST["id"] ?? null;
            $tanggal_pemasukan = $_POST["tanggal_pemasukan"];
            $tanggal_pengeluaran = $_POST["tanggal_pengeluaran"];
            $pemasukan = $_POST["pemasukan"];
            $pengeluaran = $_POST["pengeluaran"];
            $kegunaan = $_POST["kegunaan"];

            if ($aksi == "tambah") {
                $query = "INSERT INTO laporan_keuangan (tanggal_pemasukan, tanggal_pengeluaran, pemasukan, pengeluaran, kegunaan) VALUES ('$tanggal_pemasukan', '$tanggal_pengeluaran', '$pemasukan', '$pengeluaran', '$kegunaan')";
            } elseif ($aksi == "edit" && $id) {
                $query = "UPDATE laporan_keuangan SET tanggal_pemasukan='$tanggal_pemasukan', tanggal_pengeluaran='$tanggal_pengeluaran', pemasukan='$pemasukan', pengeluaran='$pengeluaran', kegunaan='$kegunaan' WHERE id='$id'";
            } elseif ($aksi == "hapus" && $id) {
                $query = "DELETE FROM laporan_keuangan WHERE id='$id'";
            }

            if (isset($query)) {
                $result = mysqli_query($conn, $query);
                header("Location: keuangan_desa.php?page=keuangan_desa");
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
        <h1>Data Laporan Keuangan Desa</h1>
        <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Data
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th><button class="fw-bold p-0 btn">No</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="tanggal_pemasukan">Tanggal Pemasukan</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="tanggal_pengeluaran">Tanggal Pengeluaran</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="pemasukan">Pemasukan</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="pengeluaran">Pengeluran</button></th>
                    <th><button class="fw-bold p-0 btn sort-btn" data-key="kegunaan">Kegunaan</button></th>
                    <th><button class="fw-bold p-0 btn no-print">Action</button></th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php 
                    $no = 1;
                    $query = "SELECT * FROM laporan_keuangan";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <tr class="table-row">
                            <td><?= $no?></td>
                            <td><?= $row["tanggal_pemasukan"]?></td>
                            <td><?= $row["tanggal_pengeluaran"]?></td>
                            <td>Rp. <?= $row["pemasukan"]?></td>
                            <td>Rp. <?= $row["pengeluaran"]?></td>
                            <td class="search-target"><?= $row["kegunaan"]?></td>
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
                                    <h5 class="modal-title" id="modalEditLabel<?= $row['id'] ?>">Edit Laporan Keuangan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pemasukan</label>
                                        <input type="date" class="form-control" name="tanggal_pemasukan" value="<?= $row['tanggal_pemasukan'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pengeluaran</label>
                                        <input type="date" class="form-control" name="tanggal_pengeluaran" value="<?= $row['tanggal_pengeluaran'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pemasukan</label>
                                        <input type="number" class="form-control" name="pemasukan" value="<?= $row['pemasukan'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Pengeluaran</label>
                                        <input type="number" class="form-control" name="pengeluaran" value="<?= $row['pengeluaran'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kegunaan</label>
                                        <input type="text" class="form-control" name="kegunaan" value="<?= $row['kegunaan'] ?>" required>
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
                                    <h5 class="modal-title" id="modalDeleteLabel<?= $row['id'] ?>">Hapus Laporan Keuangan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                    <p>Apakah kamu yakin ingin menghapus laporan keuangan dengan ID <strong><?= $row['id'] ?></strong>?</p>
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
                <h5 class="modal-title" id="modalTambahLabel">Tambah Laporan Keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="tanggal_pemasukan" class="form-label">Tanggal Pemasukan</label>
                    <input type="date" class="form-control" id="tanggal_pemasukan" name="tanggal_pemasukan" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
                    <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran" required>
                </div>
                <div class="mb-3">
                    <label for="pemasukan" class="form-label">Pemasukan</label>
                    <input type="number" class="form-control" id="pemasukan" name="pemasukan" required>
                </div>
                <div class="mb-3">
                    <label for="pengeluaran" class="form-label">Pengeluaran</label>
                    <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" required>
                </div>
                <div class="mb-3">
                    <label for="kegunaan" class="form-label">Kegunaan</label>
                    <input type="text" class="form-control" id="kegunaan" name="kegunaan" required>
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
            if (key === 'tanggal_pemasukan') return 1;
            if (key === 'tanggal_pengeluaran') return 2;
            if (key === 'pemasukan') return 3;
            if (key === 'pengeluaran') return 4;
            if (key === 'kegunaan') return 5;
            return 1;
        }

    </script>

</body>
</html>