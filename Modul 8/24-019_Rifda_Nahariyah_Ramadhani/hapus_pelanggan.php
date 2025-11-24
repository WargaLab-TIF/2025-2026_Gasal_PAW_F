<?php
include "koneksi.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Pelanggan tidak ditemukan.");
}
$id_pelanggan = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql_delete = "DELETE FROM pelanggan WHERE id = '$id_pelanggan'";
if (mysqli_query($koneksi, $sql_delete)) {
    header("Location: data_pelanggan.php?status=sukses_hapus");
    exit();
} else {
    echo "Gagal menghapus data pelanggan: " . mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>