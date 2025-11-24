<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
include "conn.php";

if (isset($_SESSION['username'])) {
    if ($_SESSION['level'] == 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/home.php");
    }
    elseif ($_SESSION['level'] == 2) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/kasir/home.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = mysqli_prepare($conn,
        "SELECT id_user, username, password, nama, level 
         FROM user 
         WHERE username = ? AND password = ?"
    );

    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $data = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['nama'] = $data['nama'];  

        if ($data['level'] == 1) {
            header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/home.php");
            exit;
        } 
        elseif ($data['level'] == 2) {
            header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/kasir/home.php");
            exit;
        }
    } 
    else {
        echo "<script>
            alert('Login gagal! Username atau password salah.');
            window.location='login.php';
        </script>";
        exit;
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
        }
        .login-box {
            width: 350px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 10px #ccc;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            width: 95%;
            padding: 10px;
            background: #1E90FF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="username" required><br>
        <input type="password" name="password" placeholder="password" required><br>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
