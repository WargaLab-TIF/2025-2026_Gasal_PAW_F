<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama', '$harga', '$stok')");
    header("location:data_barang.php");
}
?>
<h3>Tambah Barang</h3>
<form method="POST">
    Nama Barang: <br><input type="text" name="nama_barang" required><br><br>
    Harga (Rp): <br><input type="number" name="harga" required><br><br>
    Stok: <br><input type="number" name="stok" required><br><br>
    <button type="submit" name="simpan">Simpan</button>
    <a href="data_barang.php">Batal</a>
</form>