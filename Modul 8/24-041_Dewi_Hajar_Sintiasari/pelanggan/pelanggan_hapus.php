<?php
include '../session/cek_session.php';
include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id=$id");

header("Location: pelanggan_index.php");
exit;
?>