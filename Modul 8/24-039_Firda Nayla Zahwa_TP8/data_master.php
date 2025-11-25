<?php
include 'header.php';
if ($_SESSION['level'] != 1) {
    echo "<script>alert('Akses hanya untuk OWNER'); window.location='index.php';</script>";
    exit;
}
?>
<style>
    .menu {
        background: white;
        width: 400px;
        padding: 20px;
        margin: 30px auto;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }
    .menu ul li {
        margin: 10px 0;
        font-size: 18px;
    }
</style>

<div class="menu">
    <h2>Data Master</h2>
    <ul>
        <li><a href="barang.php">Data Barang</a></li>
        <li><a href="supplier.php">Data Supplier</a></li>
        <li><a href="pelanggan.php">Data Pelanggan</a></li>
        <li><a href="user.php">Data User</a></li>
    </ul>
</div>
