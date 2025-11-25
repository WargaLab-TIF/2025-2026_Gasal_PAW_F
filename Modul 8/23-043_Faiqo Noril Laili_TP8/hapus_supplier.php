<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'");

header("Location: supplier.php");
exit;
?>
