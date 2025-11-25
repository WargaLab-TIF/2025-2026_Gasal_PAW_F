<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama', alamat='$alamat', telp='$telp' WHERE id_pelanggan='$id'");
    header("location:data_pelanggan.php");
}
?>
<h3>Edit Pelanggan</h3>
<form method="POST">
    Nama: <br><input type="text" name="nama" value="<?= $d['nama_pelanggan']; ?>"><br><br>
    Alamat: <br><textarea name="alamat"><?= $d['alamat']; ?></textarea><br><br>
    Telp: <br><input type="text" name="telp" value="<?= $d['telp']; ?>"><br><br>
    <button type="submit" name="update">Update</button>
    <a href="data_pelanggan.php">Batal</a>
</form>