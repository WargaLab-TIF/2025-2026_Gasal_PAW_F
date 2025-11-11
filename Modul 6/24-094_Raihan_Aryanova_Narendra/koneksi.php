<?php

$host = 'localhost';
$user = 'root'; 
$pass = ''; 
$db   = 'db_praktikum6'; 
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    echo "Koneksi ke database gagal.";
}
?>