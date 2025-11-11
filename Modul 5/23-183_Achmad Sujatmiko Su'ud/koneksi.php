<?php
$host = "localhost";
$user = "root";
$pass = "admin"; // ganti sesuai password MySQL kamu
$db   = "store";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
