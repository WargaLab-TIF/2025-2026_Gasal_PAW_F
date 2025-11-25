<?php
if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <style>
        body{
            margin: 0;
            font-family: Arial;
        }

        .navbar {
            background: #0274bd;
            padding: 20px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-left a, .dropdown-btn {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-size: 16px;
            cursor: pointer;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: #000;
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background: #0275bd96;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .user-menu {
            color: white;
            cursor: pointer;
        }
    </style>

    <div class="navbar">

        <div class="nav-left">
            <a href="">Sistem Penjualan</a>
            <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/index.php">Home</a>

            <?php if ($_SESSION['level'] == 1): ?>
            <div class="dropdown">
                <span class="dropdown-btn">Data Master ▼</span>
                <div class="dropdown-content">
                    <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/barang/barang_index.php">Data Barang</a>
                    <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/supplier/supplier_index.php">Data Supplier</a>
                    <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/pelanggan/pelanggan_index.php">Data Pelanggan</a>
                    <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/user/user_index.php">Data User</a>
                </div>
            </div>
            <?php endif; ?>

            <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/transaksi/transaksi_index.php">Transaksi</a>
            <a href="/paw/TP8/24-041_Dewi_Hajar_Sintiasari/laporan/laporan_penjualan.php">Laporan</a>
        </div>

        <div class="dropdown">
            <span class="user-menu"><?= $_SESSION['nama']; ?> ▼</span>
            <div class="dropdown-content" style="right:0;">
                <a href="logout.php">Logout</a>
            </div>
        </div>

    </div>
</body>
</html>