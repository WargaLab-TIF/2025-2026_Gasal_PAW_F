<?php
$conn = mysqli_connect("localhost", "root", "", "storetp6");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>