<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['nama'] = $row['nama'];   
    $_SESSION['level'] = $row['level'];

    header("Location: home.php");
} else {
    echo "<script>alert('Username atau password salah'); window.location='login.php';</script>";
}
?>
