<?php
include 'koneksi.php';
$transaksi = $_POST['transaksi_id'];
$barang = $_POST['barang_id'];
$qty = $_POST['qty'];


$cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi' AND barang_id='$barang'");
if (mysqli_num_rows($cek) > 0) {
  echo "<script>alert('Barang sudah ada di transaksi ini!'); window.location='transaksi_detail_tambah.php';</script>";
  exit;
}


$brg = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang'"));
$harga_total = $brg['harga'] * $qty;


mysqli_query($koneksi, "INSERT INTO transaksi_detail(transaksi_id, barang_id, harga, qty)
VALUES('$transaksi', '$barang', '$harga_total', '$qty')");


mysqli_query($koneksi, "UPDATE transaksi 
SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi')
WHERE id='$transaksi'");

echo "<script>alert('Detail transaksi berhasil ditambahkan'); window.location='transaksi_detail.php';</script>";
?>
