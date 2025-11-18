<?php
// koneksi.php
$host = "localhost";
$user = "root";
$pass = ""; // isi sesuai konfigurasi lokalmu
$db   = "store";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
