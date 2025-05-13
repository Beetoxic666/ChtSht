<?php
    include "../configDB.php";
    $query_penduduk = mysqli_query($conn, "SELECT * FROM penduduk");
    $query_sarana_prasarana = mysqli_query($conn, "SELECT * FROM sarana_prasarana");

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
            justify-content: space-around;
            gap: 10px;
        }
        .cont-image img {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="sidebar"><?php include "../components/admin/sidebar.php"?></div>
    <div class="content">
        <?php include "../components/admin/navbar.php"?>
        <h1>Home</h1>
        <div class="cont-card">
            <div class="card">
                <div>
                    <h3>Jumlah Penduduk</h3>
                    <p><?= $rows = mysqli_num_rows($query_penduduk); ?></p>
                </div>
                <div class="info-detail">
                    <a href="penduduk_desa.php?page=penduduk_desa">Info Detail</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                    </svg>
                </div>
            </div>
            <div class="card">
                <div>
                    <h3>Jumlah Sarana</h4>
                    <p><?= $rows = mysqli_num_rows($query_sarana_prasarana); ?></p>
                </div>
                <div class="info-detail">
                    <a href="sarana_prasarana_desa.php?page=sarana_prasarana_desa">Info Detail</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="cont-image mt-3">
            <img src="" alt="" width="300" height="300">
            <img src="" alt="" width="300" height="300">
            <img src="" alt="" width="300" height="300">
            <img src="" alt="" width="300" height="300">
        </div>
    </div>
</body>
</html>