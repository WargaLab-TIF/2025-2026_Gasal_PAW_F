<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<style>
    nav {
        background: #003399;
        padding: 12px;
        display: flex;
        gap: 15px;
        align-items: center;
    }
    nav a {
        color: white;
        font-weight: bold;
        text-decoration: none;
        padding: 7px 12px;
        border-radius: 4px;
    }
    nav a:hover {
        background: #1a4ed8;
    }
    .right {
        margin-left: auto;
        color: white;
        font-weight: bold;
    }
</style>

<nav>
    <a href="index.php">Home</a>

    <?php if ($_SESSION['level'] == 1): ?>
        <a href="data_master.php">Data Master</a>
    <?php endif; ?>

    <a href="transaksi.php">Transaksi</a>
    <a href="laporan.php">Laporan</a>

    <span class="right"><?= $_SESSION['nama'] ?></span>
    <a href="logout.php" style="background: #ff4444;">Logout</a>
</nav>
