<?php
session_start();
require_once('./include/conn.php');

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

$user= $_SESSION['username'];
$sql="SELECT * FROM user WHERE username='$user'";
$tem=mysqli_query($koneksi, $sql);
$lev=mysqli_fetch_array($tem);
$wewenang=$lev['level'];

?>
<!doctype html>
<html>
<head>
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php if(isset($_SESSION['username'])):?>
    <h2>SISTEM PENJUALAN</h2>
    <div style="display:flex; align-items:center; margin-bottom:10px;">
        <h3>Selamat Datang: <?=$lev['nama']?></h3>
    </div>
    <nav class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>

        <?php if ($wewenang == 1): ?>
        <li><a href="./masters/barang.php">Barang</a></li>
        <li><a href="./masters/supplier.php">Supplier</a></li>
        <li><a href="./masters/pelanggan.php">Pelanggan</a></li>
        <li><a href="./masters/user.php">User</a></li>
        <?php endif; ?>

        <li><a href="./laporan/report_transaksi.php">Laporan</a></li>
        <li><a href="./Transaksi/transaksi.php">Transaksi</a></li>
        <li><a href="./include/logOut.php">LogOut</a></li>
    </ul>
    </nav>
    <?php endif;?>
<main class="layout">
</main>
</body>
</html>