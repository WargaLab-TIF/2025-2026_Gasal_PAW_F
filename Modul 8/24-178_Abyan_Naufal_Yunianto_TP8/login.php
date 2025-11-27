<?php
session_start();
require 'koneksi.php';

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    header("location:index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if($cek > 0){
        $data = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['status'] = "login";
        header("location:index.php");
    } else {
        echo "<script>alert('Username/Password Salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Toko</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <div class="box-login">
        <h2>Login Sistem</h2>
        <form method="POST">
            <label>Username</label><br>
            <input type="text" name="username" required><br>
            <label>Password</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit" class="btn-primary">LOGIN</button>
        </form>
    </div>
</body>
</html>