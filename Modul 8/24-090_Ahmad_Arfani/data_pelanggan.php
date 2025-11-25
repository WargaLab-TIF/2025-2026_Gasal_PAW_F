<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
    header("location:data_pelanggan.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <style>
        body{font-family:sans-serif; padding:30px;}
        .header{overflow:hidden; border-bottom:1px solid #eee; padding-bottom:10px; margin-bottom:10px;}
        .btn{padding:8px 12px; text-decoration:none; border-radius:4px; color:white; font-size:14px;}
        .green{background:#5cb85c; float:right;} .grey{background:#777; float:right; margin-right:10px;}
        .orange{background:#f0ad4e;} .red{background:#d9534f;}
        table{width:100%; border-collapse:collapse;} th,td{padding:10px; border-bottom:1px solid #ddd; text-align:left;}
    </style>
</head>
<body>
    <div class="header">
        <h2 style="float:left; margin:0; color:#31708f;">Data Pelanggan</h2>
        <a href="tambah_pelanggan.php" class="btn green">+ Tambah</a>
        <a href="index.php" class="btn grey">Kembali</a>
    </div>
    <table>
        <thead><tr><th>No</th><th>Nama</th><th>Alamat</th><th>Telp</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php
            $no=1; $q=mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while($d=mysqli_fetch_assoc($q)):
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nama_pelanggan']; ?></td>
                <td><?= $d['alamat']; ?></td>
                <td><?= $d['telp']; ?></td>
                <td>
                    <a href="edit_pelanggan.php?id=<?= $d['id_pelanggan']; ?>" class="btn orange">Edit</a>
                    <a href="data_pelanggan.php?hapus=<?= $d['id_pelanggan']; ?>" class="btn red" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>