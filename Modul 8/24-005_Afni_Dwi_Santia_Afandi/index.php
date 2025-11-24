<?php 
include "cek_login.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>

<body style="font-family: Arial; background:#f3f3f3; margin:0; padding:0;">


<div style="background:#e8dff5; padding:15px; color:purple; display:flex; justify-content:space-between; align-items:center;">
    
    <div style="font-size:20px; font-weight:bold; color:purple;">
        Store
    </div>

    <div style="margin-right:20px;">
        <b><?= $_SESSION['username']; ?></b>
        <a href="logout.php" style="margin-left:10px; color:purple; text-decoration:none;">Logout</a>
    </div>

</div>


<div style="width:90%; margin:30px auto;">

    <h2>Haloo!!<br>Selamat Datang, <?= $_SESSION['username']; ?></h2>
    <p>Silakan pilih menu di bawah ini:</p>

    <div style="margin-top:20px;">

        <?php if ($_SESSION['level'] == 1) { ?> 
            <a href="user/user.php"
               style="display:inline-block; background:#C8CEEE; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
               Data User
            </a>

            <a href="barang/barang.php"
               style="display:inline-block; background:#E8DAF0; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
               Data Barang
            </a>

            <a href="supplier/supplier.php"
               style="display:inline-block; background:#FCDCE1; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
               Data Supplier
            </a>

            <a href="pelanggan/pelanggan.php"
               style="display:inline-block; background:#C8B6FF; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
               Data Pelanggan
            </a>

            <a href="transaksi/transaksi.php"
            style="display:inline-block; background:#BBCFFF; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
            Transaksi
            </a>

            <a href="laporan/laporan.php"
            style="display:inline-block; background:#FEC8D8; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
            Laporan Penjualan
            </a>
            
        <?php } ?>

        <?php if ($_SESSION['level'] == 2) { ?>
            <a href="transaksi/transaksi.php"
            style="display:inline-block; background:#BBCFFF; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
            Transaksi
            </a>

            <a href="laporan/laporan.php"
            style="display:inline-block; background:#FEC8D8; color:purple; padding:12px 20px; margin:5px; border-radius:5px; text-decoration:none;">
            Laporan Penjualan
            </a>
        <?php } ?>

    </div>

</div>

</body>
</html>
