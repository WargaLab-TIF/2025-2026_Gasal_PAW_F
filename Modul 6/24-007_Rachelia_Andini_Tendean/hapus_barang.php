<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang ini sudah digunakan dalam transaksi, tidak bisa dihapus!');window.location='index.php';</script>";
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
        if ($hapus) {
            echo "<script>alert('Barang berhasil dihapus!');window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus barang!');window.location='index.php';</script>";
        }
    }
} else {
    echo "<script>alert('ID barang tidak ditemukan!');window.location='index.php';</script>";
}
?>
