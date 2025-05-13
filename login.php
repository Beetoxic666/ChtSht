<?php 
    session_start();
    include "configDB.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = mysqli_query($conn, "SELECT * FROM user WHERE nama_user='$username' AND password='$password'");
        
        if(mysqli_num_rows($query) == 1) {
            $_SESSION['username'] = $username;
            header("Location: admin/home.php");
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
    <style>
        body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 80vh;
            margin: 0;
            padding: 0;

        }
    </style>
</head>
<body>
    <div class="card p-4">
        <h2 class="text-center">Halaman Login</h2>
        <h4 class="text-center">Admin</h4>
        <form action="" method="post" class="d-flex flex-column justify-content-center items-center">
            <p>Username</p>
            <input class="form-control" type="text" name="username" required>
            <p>Password</p>
            <input class="form-control" type="password" name="password" required>

            <div class="d-flex justify-content-around mt-2">
                <button class="btn btn-primary" type="submit">Login</button>
                <button class="btn btn-warning"><a href="index.php" class="text-decoration-none text-white">Home</a></button>
            </div>
        </form>
    </div>
</body>
</html>