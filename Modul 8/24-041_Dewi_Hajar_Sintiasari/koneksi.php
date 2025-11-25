<?php

$servername = 'localhost';
$username = 'root';
$pw = '';
$dbname = 'storetp8'; 
$koneksi = mysqli_connect($servername, $username, $pw, $dbname);

if (!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>