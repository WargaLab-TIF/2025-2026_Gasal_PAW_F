<?php
include "koneksi.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Supplier tidak ditemukan.");
}
$id_supplier = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql_delete = "DELETE FROM supplier WHERE id = '$id_supplier'";

if (mysqli_query($koneksi, $sql_delete)) {
    header("Location: data_supplier.php?status=sukses_hapus");
    exit();
} else {
    echo "Gagal menghapus data supplier: " . mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>