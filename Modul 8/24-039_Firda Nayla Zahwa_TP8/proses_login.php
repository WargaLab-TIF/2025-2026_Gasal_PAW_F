<?php
session_start();
require 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($result);

if ($cek == 1) {
    $data = mysqli_fetch_assoc($result);

    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['level'] = $data['level'];

    header("Location: index.php");
    exit;
} else {
    echo "<script>alert('Username atau password salah'); 
    window.location='login.php';</script>";
}
?>
