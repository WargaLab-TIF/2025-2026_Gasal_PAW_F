<?php
// hapus_transaksi.php

include 'koneksi.php';

// Ambil ID Transaksi dari parameter URL
$id_transaksi = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_transaksi === 0) {
    echo "<script>alert('ID Transaksi tidak valid.');window.location='transaksi.php';</script>";
    exit;
}

try {
    // Memulai Transaksi (agar semua berhasil atau semua gagal)
    $koneksi->begin_transaction();

    // 1. Hapus data dari tabel pembayaran (Tabel Anak)
    // Cek dulu apakah ada data pembayaran untuk transaksi ini
    $koneksi->query("DELETE FROM pembayaran WHERE transaksi_id = $id_transaksi");
    
    // 2. Hapus data dari tabel transaksi_detail (Tabel Anak)
    $koneksi->query("DELETE FROM transaksi_detail WHERE transaksi_id = $id_transaksi");

    // 3. Hapus data dari tabel transaksi (Tabel Utama)
    $koneksi->query("DELETE FROM transaksi WHERE id = $id_transaksi");

    // Jika semua query berhasil, lakukan commit
    $koneksi->commit();

    echo "<script>alert('Transaksi ID $id_transaksi berhasil dihapus!');window.location='transaksi.php';</script>";

} catch (mysqli_sql_exception $e) {
    // Jika ada query yang gagal, lakukan rollback
    $koneksi->rollback();
    echo "<script>alert('Gagal menghapus transaksi: " . $e->getMessage() . "');window.location='transaksi.php';</script>";
}

// Tutup koneksi
$koneksi->close();

?>