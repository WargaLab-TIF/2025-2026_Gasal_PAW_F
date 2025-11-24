<?php
include "../cek_login.php";
include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");

header("Location: barang.php");
?>
