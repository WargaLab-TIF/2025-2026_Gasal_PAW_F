<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok' WHERE id_barang='$id'");
    header("location:data_barang.php");
}
?>
<h3>Edit Barang</h3>
<form method="POST">
    Nama Barang: <br><input type="text" name="nama_barang" value="<?= $d['nama_barang']; ?>"><br><br>
    Harga: <br><input type="number" name="harga" value="<?= $d['harga']; ?>"><br><br>
    Stok: <br><input type="number" name="stok" value="<?= $d['stok']; ?>"><br><br>
    <button type="submit" name="update">Update</button>
    <a href="data_barang.php">Batal</a>
</form>