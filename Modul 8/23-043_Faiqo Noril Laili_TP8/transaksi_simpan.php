<?php
include 'koneksi.php';
$waktu = $_POST['waktu_transaksi'];
$ket = $_POST['keterangan'];
$pelanggan = $_POST['pelanggan_id'];

mysqli_query($koneksi, "INSERT INTO transaksi(waktu_transaksi, keterangan, total, pelanggan_id)
VALUES('$waktu', '$ket', 0, '$pelanggan')");

echo "<script>alert('Transaksi berhasil ditambah'); window.location='transaksi.php';</script>";
?>
