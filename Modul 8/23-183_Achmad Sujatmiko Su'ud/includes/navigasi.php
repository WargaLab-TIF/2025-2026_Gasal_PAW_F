<?php
// includes/navigasi.php
$level = (int)$_SESSION['level']; 

?>

<div class="navbar">
    <a href="index.php">Sistem Penjualan</a> 
    <a href="index.php">Home</a>

    <?php if ($level === 1) : 
    ?>
        <div class="dropdown">
            <button class="dropbtn">Data Master</button>
            <div class="dropdown-content">
                <a href="pages/barang/barang_list.php">Data Barang</a>
                <a href="pages/supplier/supplier_list.php">Data Supplier</a>
                <a href="pages/pelanggan/pelanggan_list.php">Data Pelanggan</a>
                <a href="pages/user/user_list.php">Data User</a>
            </div>
        </div>
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>

    <?php elseif ($level === 2) : 
    ?>
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
    <?php endif; ?>

    <div class="dropdown logout-link">
        <button class="dropbtn"><?= htmlspecialchars($_SESSION['nama']) ?> (Level: <?= $level ?>)</button>
        <div class="dropdown-content" style="right: 0;">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>