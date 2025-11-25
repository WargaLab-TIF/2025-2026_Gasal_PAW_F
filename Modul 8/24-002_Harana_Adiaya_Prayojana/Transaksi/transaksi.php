<?php
session_start();
require_once('../include/conn.php');

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}

$user= $_SESSION['username'];
$sql="SELECT * FROM user WHERE username='$user'";
$tem=mysqli_query($koneksi, $sql);
$lev=mysqli_fetch_array($tem);
$wewenang=$lev['level'];

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $sql_hapus="DELETE FROM transaksi WHERE id=$id";
    mysqli_query($koneksi, $sql_hapus);
    header("Location: transaksi.php"); 
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h2>SISTEM PENJUALAN</h2>
    <div style="display:flex; align-items:center; margin-bottom:10px;">
        <h3>Selamat Datang: <?=$lev['nama']?></h3>
    </div>
<nav class="menu">
    <ul>
        <li><a href="../index.php">Home</a></li>

        <?php if ($wewenang == 1): ?>
        <li><a href="../masters/barang.php">Barang</a></li>
        <li><a href="../masters/supplier.php">Supplier</a></li>
        <li><a href="../masters/pelanggan.php">Pelanggan</a></li>
        <li><a href="../masters/user.php">User</a></li>
        <?php endif; ?>
        <li><a href="../laporan/report_transaksi.php">Laporan</a></li>
        <li><a href="transaksi.php">Transaksi</a></li>
        <li><a href="../include/logOut.php">LogOut</a></li>
    </ul>
    </nav>
    <br>
<main class="layout">
    <div style="display:flex; align-items:center; margin-bottom:10px;">
        <form action="form_add.php" ><button class="adding">Tambah Transaksi</button></form><br>
        <form action="transaksiD.php"><button class="adding">Tambah Transaksi Detail</button></form>
    </div>
    <table border="1" cellpadding="8">
        <tr>
            <th>No</th><th>ID Transaksi</th><th>Waktu Transaksi</th><th>Nama Pelanggan</th><th>Keterangan</th><th>Total</th><th>Tindakan</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM transaksi");
            $no=1;
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <?php 
                $nam=$row['pelanggan_id'];
                $TemNam=mysqli_query($koneksi,"SELECT nama FROM pelanggan WHERE id='$nam'"); 
                $namPel=mysqli_fetch_array($TemNam);
            ?>
            <td><?=$no++;?></td>
            <td><?=$row['id']?></td>
            <td><?=$row['waktu_transaksi']?></td>
            <td><?=$namPel['nama']?></td>
            <td><?=$row['keterangan']?></td>
            <td><?=$row['total']?></td>
            <td>
                <div style="display:flex; align-items:center; margin-bottom:10px; justify-content: space-between;">
                    <button class="detail" onclick="location.href='detail.php?id=<?=$row['id']?>'">Lihat Detail</button>
                    <button class="del" onclick="if(confirm('Yakin hapus Transaksi <?=$row['keterangan']?>?')) location.href='?delete=<?=$row['id']?>'">Hapus</button>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <h2>Transaksi Detail</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Transaksi ID</th><th>Nama Barang</th><th>Harga</th><th>QTY</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM transaksi_detail");
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <?php 
            $barTransD=$row['barang_id'];
            $sqlbarTransD=mysqli_query($koneksi,"SELECT nama_barang FROM barang WHERE id=$barTransD");
            $nambar=mysqli_fetch_array($sqlbarTransD)
            ?>
            <td><?=$row['transaksi_id']?></td>
            <td><?=$nambar['nama_barang']?></td>
            <td><?=$row['harga']?></td>
            <td><?=$row['qty']?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>