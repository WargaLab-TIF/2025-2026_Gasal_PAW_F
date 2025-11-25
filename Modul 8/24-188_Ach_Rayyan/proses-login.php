<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']); 

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

if ($data) {

    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['level'] = $data['level'];

    if ($data['level'] == 1) {
        header("Location: owner/home.php");
        exit;
    } else {
        header("Location: kasir/home.php");
        exit;
    }

} else {
    echo "Kombinasi username dan password salah. Silahkan <a href='login.php'>login</a> lagi!";
}
?>