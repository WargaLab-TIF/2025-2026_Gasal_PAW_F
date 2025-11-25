<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}
$level = $_SESSION['level'];
$nama  = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Sistem</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #fff; }
        .navbar { background-color: #31708f; overflow: hidden; padding: 0 20px; }
        .navbar a { float: left; display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none; }
        .navbar a:hover, .dropdown:hover .dropbtn { background-color: #245269; }
        .dropdown { float: left; overflow: hidden; }
        .dropdown .dropbtn { font-size: 16px; border: none; outline: none; color: white; padding: 14px 16px; background-color: inherit; font-family: inherit; margin: 0; cursor: pointer; }
        .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px rgba(0,0,0,0.2); z-index: 1; }
        .dropdown-content a { float: none; color: black; padding: 12px 16px; text-decoration: none; display: block; text-align: left; }
        .dropdown-content a:hover { background-color: #ddd; }
        .dropdown:hover .dropdown-content { display: block; }
        .right { float: right; }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" style="font-weight:bold;">SISTEM PENJUALAN</a>
    <a href="index.php">Home</a>

    <?php if ($level == 1) : ?>
    <div class="dropdown">
        <button class="dropbtn">Data Master ▼</button>
        <div class="dropdown-content">
            <a href="data_barang.php">Data Barang</a>
            <a href="data_supplier.php">Data Supplier</a>
            <a href="data_pelanggan.php">Data Pelanggan</a>
            <a href="data_user.php">Data User (CRUD)</a>
        </div>
    </div>
    <?php endif; ?>

    <a href="transaksi.php">Transaksi</a>
    <a href="laporan.php">Laporan</a>

    <div class="right">
        <a href="#"><?php echo $nama; ?> (<?php echo ($level==1)?'Owner':'Kasir'; ?>)</a>
        <a href="logout.php" style="background-color: #d9534f;">Logout</a>
    </div>
</div>

<div style="padding: 20px; text-align:center; margin-top:50px;">
    <h1>Selamat Datang di Dashboard</h1>
    <h3>Halo, <?php echo $nama; ?></h3>
    <p>Anda login sebagai: <b><?php echo ($level==1) ? "Owner (Level 1)" : "Kasir (Level 2)"; ?></b></p>
</div>

</body>

</html>
