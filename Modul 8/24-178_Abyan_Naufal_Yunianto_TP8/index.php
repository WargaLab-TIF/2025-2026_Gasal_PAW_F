<?php
session_start();
// Cek Login
if($_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}
$level = $_SESSION['level'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h3>Menu Utama</h3>
    <a href="index.php" class="active">Home</a>
    
    <?php if($level == 1) { ?>
        <p class="menu-label">Data Master</p>
        <a href="data_barang.php">Data Barang</a>
        <a href="data_supplier.php">Data Supplier</a>
        <a href="data_pelanggan.php">Data Pelanggan</a>
        <a href="data_user.php">Data User</a>
    <?php } ?>

    <p class="menu-label">Transaksi</p>
    <a href="transaksi.php">Data Transaksi</a>
    <a href="report_transaksi.php">Laporan</a>

    <br><br>
    <a href="logout.php" class="btn-logout">LOGOUT</a>
</div>

<div class="content">
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
    <p>Anda login sebagai: <b><?php echo ($level==1)?'OWNER':'KASIR'; ?></b></p>
    
    <div class="card">
        <h3>Info Sistem</h3>
        <p>Silakan pilih menu di sebelah kiri untuk mengelola data.</p>
    </div>
</div>

</body>
</html>