<?php
include 'koneksi.php';

$id = $_GET['id'];
$cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');window.location='index.php';</script>";
    exit;
}

$hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
if ($hapus) {
    echo "<script>alert('Barang berhasil dihapus.');window.location='index.php';</script>";
}
?>