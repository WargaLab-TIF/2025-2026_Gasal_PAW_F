<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $sql   = mysqli_query($koneksi, $query);
    $data  = mysqli_fetch_assoc($sql);

    if ($data) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['level']    = $data['level'];
        $_SESSION['nama']     = $data['nama'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px;
            font-family: Arial;
            background: #ffffffff;
        }

        .container {
            border-radius: 8px;
            padding: 0 20px 10px 20px;
            background: #e3e3e3ff;
            text-align: center;
            min-width: 350px;
        }

        h2 {
            color: skyblue;
        }

        input {
            width: 90%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-login {
            margin-top: 15px;
            padding: 10px 0;
            width: 95%;
            background: skyblue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        small {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Login Admin</h2>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>

        <button type="submit" class="btn-login"><b>Login</b></button>
    </form>

    <?php 
    if (!empty($error)) {
        echo "<small>$error</small>";
    }
    ?>
</div>

</body>
</html>