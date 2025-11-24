<?php
include "koneksi.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Akses ditolak atau ID Barang tidak ditemukan.");
}
$id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql_delete = "DELETE FROM barang WHERE id = '$id_barang'";

if (mysqli_query($koneksi, $sql_delete)) {
    header("Location: data_barang.php?status=sukses_hapus");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>