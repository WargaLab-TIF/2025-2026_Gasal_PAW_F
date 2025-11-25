<?php
session_start();
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];  
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];

    $insert = mysqli_query($koneksi,
        "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
         VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')"
    );

    if ($insert) {
        echo "<script>alert('Detail transaksi berhasil ditambahkan!'); 
        window.location='transaksi_index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah detail transaksi!'); 
        window.location='tambah_transaksi_detail.php';</script>";
    }
}
?>