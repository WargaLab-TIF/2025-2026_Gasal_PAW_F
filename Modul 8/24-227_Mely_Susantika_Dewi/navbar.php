<?php
// session_start();
$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? 'User';

// untuk menu aktif
$active = basename($_SERVER['PHP_SELF']);
?>

<style>
.navbar {
    background: #2caa41;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    font-family: "Times New Roman", serif;
}
.navbar ul {
    list-style: none;
    display: flex;
    width: 100%;
    margin: 0;
    padding: 0;
}
.navbar li { margin-right: 25px; }
.navbar a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 8px;
}
.active-menu {
    background: #1d7b2f;
    border-radius: 5px;
}
.dropdown-content {
    display: none;
    position: absolute;
    background: white;
    min-width: 160px;
}
.dropdown-content a { color: black; display: block; padding: 8px; }
.dropdown:hover .dropdown-content { display: block; }
.nav-right { margin-left: auto; color: white; }
</style>

<nav class="navbar">
    <ul>
        <li><a href="index.php" class="<?= $active=='index.php' ? 'active-menu' : '' ?>">Home</a></li>

        <?php if ($level == 1): ?>
        <li class="dropdown">
            <a href="#" class="<?= in_array($active, ['barang.php','pelanggan.php','supplier.php','user.php']) ? 'active-menu':'' ?>">
                Data Master ▾
            </a>
            <div class="dropdown-content">
                <a href="barang.php">Data Barang</a>
                <a href="supplier.php">Data Supplier</a>
                <a href="pelanggan.php">Data Pelanggan</a>
                <a href="user.php">Data User</a>
            </div>
        </li>
        <?php endif; ?>

        <li><a href="transaksi.php" class="<?= $active=='transaksi.php' ? 'active-menu' : '' ?>">Transaksi</a></li>

        <li><a href="laporan.php" class="<?= $active=='laporan.php' ? 'active-menu' : '' ?>">Laporan</a></li>

        <li class="nav-right">
            <?= $nama_user ?> | <a style="color:yellow;" href="logout.php">Logout</a>
        </li>
    </ul>
</nav>
