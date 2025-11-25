<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password']; 
$password = hash("sha256", $password); 

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

if ($data) {

    // Set session
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['level'] = $data['level'];

    // Redirect berdasarkan level
    if ($data['level'] == 1) {
        // Admin
        header("Location: owner/home.php");
        exit;
    } else {
        // User biasa
        header("Location: kasir/home.php");
        exit;
    }

} else {
    echo "Kombinasi username dan password salah. Silahkan <a href='login.php'>login</a> lagi!";
}
?>