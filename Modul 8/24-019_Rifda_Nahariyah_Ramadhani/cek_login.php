<?php 
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password']; 

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$login = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($login);
if($cek > 0){
    $data = mysqli_fetch_assoc($login);

    $_SESSION['username'] = $username;
    $_SESSION['nama_user'] = $data['nama']; 
    $_SESSION['level'] = $data['level']; 
    $_SESSION['status'] = "login";

    header("location:dashboard.php");

} else {
    header("location:login.php?pesan=gagal");
}
mysqli_close($koneksi);
?>