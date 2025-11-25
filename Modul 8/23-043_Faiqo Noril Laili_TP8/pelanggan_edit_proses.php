<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jk = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, 
"UPDATE pelanggan SET 
    nama='$nama',
    jenis_kelamin='$jk',
    telp='$telp',
    alamat='$alamat'
WHERE id='$id'");

header("Location: pelanggan.php");
?>
