<?php
$level = $_SESSION['level'];
$username = $_SESSION['username'];
?>

<style>
.navbar {
    background:#003c8f;
    padding:12px 20px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-family:Arial;
}

.nav-left a {
    color:white;
    margin-right:20px;
    text-decoration:none;
    font-weight:bold;
}

.dropdown {
    position:relative;
    display:inline-block;
}

.dropdown > a {
    cursor:pointer;
}

.dropdown-content {
    display:none;
    position:absolute;
    background:#0057d1;
    min-width:170px;
    border-radius:6px;
    padding:10px 0;
    box-shadow:0px 3px 8px rgba(0,0,0,0.3);
}

.dropdown-content a {
    display:block;
    padding:10px 15px;
    color:white;
    text-decoration:none;
}

.dropdown-content a:hover {
    background:#003c8f;
}

.dropdown:hover .dropdown-content {
    display:block;
}
</style>

<div class="navbar">

    <div class="nav-left">
        <a href="home.php">Home</a>

        <?php if ($_SESSION['level'] == 1): ?>

        <div class="dropdown">
            <a>Data Master ▾</a>
            <div class="dropdown-content">
                <a href="data_supplier.php">Data Supplier</a>
                <a href="data_barang.php">Data Barang</a>
                <a href="data_pelanggan.php">Data Pelanggan</a>
                <a href="data_user.php">Data User</a>
            </div>
        </div>

        <a href="transaksi.php">Transaksi</a>
        <a href="report_transaksi.php">Laporan</a>

        <?php elseif ($_SESSION['level'] == 2): ?>

        <a href="transaksi.php">Transaksi</a>
        <a href="report_transaksi.php">Laporan</a>

        <?php endif; ?>
    </div>

    <div class="nav-right">
        <span><?= $_SESSION['nama'] ?></span>
        <a href="logout.php" style="color:#ff8a8a;">Logout</a>
    </div>

</div>
