<?php
include "auth.php"; // Pastikan session sudah start di auth.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan</title>
    
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #2c3e50;
            color: white;
        }

        .nav-left {
            display: flex;
            gap: 25px;
            font-size: 16px;
            align-items: center;
        }

        .nav-left a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-left a:hover {
            text-decoration: underline;
        }

        .nav-left .dropdown {
            position: relative;
            display: inline-block;
        }

        .nav-left .dropbtn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }

        .nav-left .dropbtn:hover {
            text-decoration: underline;
        }

        .nav-left .dropdown-content {
            display: none;
            position: absolute;
            background-color: #34495e;
            min-width: 160px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            overflow: hidden;
            z-index: 10;
        }

        .nav-left .dropdown-content a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-left .dropdown-content a:hover {
            background-color: #2c3e50;
        }

        .nav-left .dropdown:hover .dropdown-content {
            display: block;
        }

        .nav-right .dropdown {
            position: relative;
            display: inline-block;
        }

        .nav-right .dropbtn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }

        .nav-right .dropbtn:hover {
            text-decoration: underline;
        }

        .nav-right .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            left: auto;
            background-color: #34495e;
            min-width: 120px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            overflow: hidden;
            z-index: 10;
        }

        .nav-right .dropdown-content a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-right .dropdown-content a:hover {
            background-color: #2c3e50;
        }

        .nav-right .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="nav-left">
            <a href="admin.php">Sistem Penjualan</a>
            <a href="admin.php">Home</a>

            <div class="dropdown">
                <button class="dropbtn">Data Master</button>
                <div class="dropdown-content">
                    <a href="barang.php">Data Barang</a>
                    <a href="supplier.php">Data Supplier</a>
                    <a href="pelanggan.php">Data Pelanggan</a>
                    <a href="user.php">Data User</a>
                </div>
            </div>

            <a href="./transaksi/">Transaksi</a>
            <a href="./transaksi/report_transaksi.php">Laporan</a>
        </div>

        <div class="nav-right">
            <div class="dropdown">
                <button class="dropbtn"><?= htmlspecialchars($_SESSION['nama'] ?? '') ?></button>
                <div class="dropdown-content">
                    <a href="proses/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
