<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");

if (!$koneksi) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
