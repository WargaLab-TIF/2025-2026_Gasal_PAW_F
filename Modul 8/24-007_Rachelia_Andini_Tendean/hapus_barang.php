<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 1) {
    echo "<script>alert('Akses Ditolak! Hanya Owner yang berhak menghapus Data Master.'); window.location='master.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    
    $cek = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE barang_id='$id'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Gagal! Barang ini sudah digunakan dalam transaksi, tidak bisa dihapus.');window.location='master.php';</script>";
        exit;
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
        
        if ($hapus) {
            echo "<script>alert('Barang berhasil dihapus!');window.location='master.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus barang! Kesalahan sistem atau database.');window.location='master.php';</script>";
        }
        exit;
    }
} 

header("Location: barang.php");
exit;
?>