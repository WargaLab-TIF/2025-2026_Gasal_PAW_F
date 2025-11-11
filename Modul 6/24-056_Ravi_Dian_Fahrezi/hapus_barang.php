<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id_barang = (int)$_GET['id'];

    // 1. Validasi: Cek apakah barang sudah digunakan di transaksi_detail
    $sql_cek = "SELECT id FROM transaksi_detail WHERE barang_id = $id_barang";
    $query_cek = mysqli_query($conn, $sql_cek);

    if (mysqli_num_rows($query_cek) > 0) {
        // Jika barang sudah digunakan, tidak bisa dihapus
        $pesan = "Barang tidak dapat dihapus karena digunakan dalam transaksi detail";
        header("Location: index.php?error=" . urlencode($pesan));
        exit;
    } else {
        // 2. Jika barang belum digunakan, boleh dihapus
        $sql_hapus = "DELETE FROM barang WHERE id = $id_barang";

        if (mysqli_query($conn, $sql_hapus)) {
            header("Location: index.php");
            exit;
        } else {
            $pesan = "Gagal menghapus barang.";
            header("Location: index.php?error=" . urlencode($pesan));
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
