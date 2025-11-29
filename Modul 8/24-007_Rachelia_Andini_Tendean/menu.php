<?php
$level = $_SESSION['level'] ?? 0;
$nama_user = htmlspecialchars($_SESSION['nama'] ?? 'Pengguna');
?>

<div style="background-color: #2b2b2b; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; font-family: Arial, sans-serif;">
    <div style="font-size: 18px; font-weight: bold;">Sistem Penjualan</div>
    <div style="display: flex; align-items: center;">
        <a href="index.php" style="color: white; text-decoration: none; margin-left: 15px;">Home</a>
        
        <?php 
        if ($level == 1) : 
        ?>
            <span style="margin-left: 15px; color: #aaa;">|</span>
            <a href="master.php" style="color: white; text-decoration: none; margin-left: 15px;">Data Master</a>
            <span style="margin-left: 15px; color: #aaa;">|</span>
        <?php endif; ?>

        <a href="transaksi.php" style="color: white; text-decoration: none; margin-left: 15px;">Transaksi</a>
        <a href="report.php" style="color: white; text-decoration: none; margin-left: 15px;">Laporan</a>
        
        <?php if ($level == 1 || $level == 2) : ?>
            <span style="color: #ffc107; margin-left: 20px; font-weight: bold;">Halo, <?= $nama_user ?>!</span>
        <?php endif; ?>
        
        <a href="logout.php" style="background: #dc3545; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; margin-left: 20px;">Logout</a>
    </div>
</div>