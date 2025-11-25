<?php
include '../session/cek_owner.php';
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");

header("Location: barang_index.php");
exit;
?>