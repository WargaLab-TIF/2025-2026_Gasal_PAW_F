<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
