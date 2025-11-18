<?php
include "koneksi.php";
$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM transaksi WHERE id='$id'");
mysqli_query($conn,"DELETE FROM transaksi_detail WHERE transaksi_id='$id'");

echo "<script>alert('Data berhasil dihapus');window.location='master.php';</script>";
?>
