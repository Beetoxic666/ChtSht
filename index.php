<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Desa Rimba Beringin</title>
    <style>
        ul {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-top: 10px;
        }

        ul li {
            list-style: none;
            border-bottom: 1px solid black;
        }

        ul li a {
            text-decoration: none;
            color: black;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
        }
    </style>
</head>
<body>
    <header>
        <ul>
            <li><a href="user/home.php">Home</a></li>
            <li><a href="?page=sejara.php">Sejarah</a></li>
            <li><a href="?page=visi_misi.php">Visi Misi</a></li>
            <li><a href="?page=contact">Contact</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </header>
    <main>
    <?php if(isset($_GET['page']) && $_GET['page'] == 'sejarah') {

    } else if(isset($_GET['page']) && $_GET['page'] == 'visi_misi') {

    } else if(isset($_GET['page']) && $_GET['page'] == 'contact') {

    } else {
        echo "
        <h1>Selamat Datang</h1>
        <h3>Di Desa Rimba Beringin</h3>
        <p>Kami menyediakan informasi yang anda butuhkan</p>
        ";
    } ?>
    </main>
</body>
</html>