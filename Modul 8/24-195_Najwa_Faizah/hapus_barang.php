<?php
include 'koneksi.php';

$id_barang = $_GET['id'];
$cek_detail = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE id_barang = '$id_barang'");

if (mysqli_num_rows($cek_detail) > 0) {
    echo "<script>alert('Barang tidak bisa dihapus karena sudah digunakan dalam transaksi.'); window.location = 'index.php';</script>";
} else {
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang = '$id_barang'");
    echo "<script>alert('Barang berhasil dihapus!'); window.location = 'index.php';</script>";
}
?>
