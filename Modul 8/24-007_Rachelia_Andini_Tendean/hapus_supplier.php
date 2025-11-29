<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    
    $cek_barang = mysqli_query($koneksi, "SELECT supplier_id FROM barang WHERE supplier_id='$id'");
    
    if (mysqli_num_rows($cek_barang) > 0) {
        echo "<script>alert('Gagal! Supplier ini sudah digunakan oleh data barang, tidak bisa dihapus.');window.location='master.php';</script>";
        exit;
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'");
        
        if ($hapus) {
            echo "<script>alert('Supplier berhasil dihapus!');window.location='master.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus supplier! Kesalahan sistem atau database.');window.location='master.php';</script>";
        }
        exit;
    }
} 

header("Location: supplier.php");
exit;
?>