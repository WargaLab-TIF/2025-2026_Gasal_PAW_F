<?php
$level = $_SESSION['level'];
?>

<nav>
    <a href="../index.php">Home</a> |

    <?php if ($level == 1): ?>
        <!-- OWNER -->
        <a href="../barang.php">Barang</a> |
        <a href="pages/supplier.php">Supplier</a> |
        <a href="pages/pelanggan.php">Pelanggan</a> |
        <a href="pages/user.php">User</a> |
        <a href="pages/transaksi.php">Transaksi</a> |
        <a href="pages/laporan.php">Laporan</a> |
    <?php elseif ($level == 2): ?>
        <!-- KASIR -->
        <a href="pages/transaksi.php">Transaksi</a> |
        <a href="pages/laporan.php">Laporan</a> |
    <?php endif; ?>

    <a href="../logout.php">Logout</a>
</nav>
<br>
