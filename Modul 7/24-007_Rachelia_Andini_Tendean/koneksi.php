<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjual");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
