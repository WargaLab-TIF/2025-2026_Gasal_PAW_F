<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "store";

$koneksi = mysqli_connect($servername, $username, $password, $database);
if($koneksi){
    // echo "Berhasil Terkoneksi";
}
?>