<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, "INSERT INTO pelanggan VALUES('$id','$nama','$jk','$telp','$alamat')");

header("Location: pelanggan.php");
?>
