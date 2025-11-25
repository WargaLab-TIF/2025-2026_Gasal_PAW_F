<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, alamat, telp) VALUES ('$nama', '$alamat', '$telp')");
    header("location:data_pelanggan.php");
}
?>
<h3>Tambah Pelanggan</h3>
<form method="POST">
    Nama: <br><input type="text" name="nama" required><br><br>
    Alamat: <br><textarea name="alamat"></textarea><br><br>
    Telp: <br><input type="text" name="telp"><br><br>
    <button type="submit" name="simpan">Simpan</button>
    <a href="data_pelanggan.php">Batal</a>
</form>