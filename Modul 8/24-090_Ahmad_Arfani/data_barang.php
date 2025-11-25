<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    header("location:data_barang.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <style>
        body { font-family: sans-serif; padding: 30px; }
        .header { overflow: hidden; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        h2 { float: left; color: #31708f; margin: 0; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; }
        .btn-green { background: #5cb85c; float: right; }
        .btn-grey { background: #777; float: right; margin-right: 10px; }
        .btn-orange { background: #f0ad4e; }
        .btn-red { background: #d9534f; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Barang</h2>
        <a href="tambah_barang.php" class="btn btn-green">+ Tambah Barang</a>
        <a href="index.php" class="btn btn-grey">Kembali</a>
    </div>
    <table>
        <thead><tr><th>No</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php
            $no=1; $q=mysqli_query($koneksi, "SELECT * FROM barang");
            while($d=mysqli_fetch_assoc($q)):
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nama_barang']; ?></td>
                <td>Rp<?= number_format($d['harga']); ?></td>
                <td><?= $d['stok']; ?></td>
                <td>
                    <a href="edit_barang.php?id=<?= $d['id_barang']; ?>" class="btn btn-orange">Edit</a>
                    <a href="data_barang.php?hapus=<?= $d['id_barang']; ?>" class="btn btn-red" onclick="return confirm('Hapus barang ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>