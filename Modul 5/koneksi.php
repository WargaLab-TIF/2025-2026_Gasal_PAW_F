<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "store"; // sesuai dengan database kamu di phpMyAdmin

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
