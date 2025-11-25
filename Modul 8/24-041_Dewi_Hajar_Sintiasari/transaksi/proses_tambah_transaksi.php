<?php
session_start();
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_pelanggan = $_POST['id_pelanggan'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $waktu = date('Y-m-d H:i:s');

    $insert = mysqli_query($koneksi,
        "INSERT INTO transaksi (waktu_transaksi, id_pelanggan, keterangan, total)
         VALUES ('$waktu', '$id_pelanggan', '$keterangan', '$total')"
    );

    if ($insert) {
        echo "<script>alert('Transaksi berhasil ditambahkan!'); 
        window.location='transaksi_index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah transaksi!'); 
        window.location='tambah_transaksi.php';</script>";
    }
}
?>