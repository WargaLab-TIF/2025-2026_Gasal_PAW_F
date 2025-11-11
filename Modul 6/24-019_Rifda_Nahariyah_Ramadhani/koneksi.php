<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "store";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}