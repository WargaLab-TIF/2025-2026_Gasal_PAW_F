<?php
$conn = mysqli_connect("localhost", "root", "admin", "pelanggan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
