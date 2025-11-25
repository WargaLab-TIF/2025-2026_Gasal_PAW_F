<?php
include '../session/cek_owner.php';
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'");

header("Location: supplier_index.php");
exit;
?>