<?php

$servername = 'localhost';
$user = 'root';
$password = '';
$dbname = 'storetp6_2';

$conn = mysqli_connect($servername, $user, $password, $dbname);

if (!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>