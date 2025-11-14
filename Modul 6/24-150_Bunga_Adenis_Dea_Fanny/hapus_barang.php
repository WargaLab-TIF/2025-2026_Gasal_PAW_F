<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM transaksi_detail WHERE barang_id='$id'");
    $data = mysqli_fetch_assoc($cek);

    if ($data['jml'] > 0) {
        echo "<script>alert('Barang sudah digunakan dalam transaksi dan tidak bisa dihapus!');window.location='index.php';</script>";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
        if ($hapus) {
            echo "<script>alert('Barang berhasil dihapus!');window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus barang!');window.location='index.php';</script>";
        }
    }
} else {
    header("Location: index.php");
}
?>
