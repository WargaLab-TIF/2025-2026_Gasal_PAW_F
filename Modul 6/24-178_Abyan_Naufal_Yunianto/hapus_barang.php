<?php
include 'koneksi.php';
$id = $_GET['id'];

$cek = $koneksi->query("SELECT * FROM transaksi_detail WHERE
barang_id='$id'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Barang ini tidak dapat dihapus karena sudah digunakan di transaksi!');window.location='index.php';</script>";
    exit;
}

$koneksi->query("DELETE FROM barang WHERE id='$id'");
echo "<script>alert('Barang berhasil dihapus!');window.location='index.php';</script>";
?>