<?php
$conn = mysqli_connect("localhost", "root", "", "penjual");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
