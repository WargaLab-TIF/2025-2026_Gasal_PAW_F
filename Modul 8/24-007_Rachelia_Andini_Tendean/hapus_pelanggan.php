<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['level'] != 1) {
    echo "<script>alert('Akses Ditolak! Hanya Owner yang berhak menghapus Data Master.'); window.location='index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    
    $cek_transaksi = mysqli_query($koneksi, "SELECT pelanggan_id FROM transaksi WHERE pelanggan_id='$id'");
    
    if ($cek_transaksi === false) {
        echo "<script>alert('ERROR DATABASE: Gagal memeriksa penggunaan pelanggan.');window.location='master.php';</script>";
        exit;
    }

    if (mysqli_num_rows($cek_transaksi) > 0) {
        echo "<script>alert('Gagal! Pelanggan ini sudah memiliki riwayat transaksi, tidak bisa dihapus.');window.location='master.php';</script>";
        exit;
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id='$id'");
        
        if (mysqli_affected_rows($koneksi) == 1) {
            echo "<script>alert('Pelanggan berhasil dihapus!');window.location='master.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus pelanggan! ID tidak ditemukan atau kesalahan sistem.');window.location='master.php';</script>";
        }
        exit;
    }
} 


header("Location: pelanggan.php");
exit;
?>