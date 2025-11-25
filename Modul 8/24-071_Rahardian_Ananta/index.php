<?php
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: login.php");
        exit();
    }
    require "conn.php";
    $nama_user = $_SESSION['username'];
    $q1 = mysqli_query($conn, "SELECT COUNT(*) as total FROM barang");
    $jml_barang = mysqli_fetch_assoc($q1)['total'];
    $q2 = mysqli_query($conn, "SELECT COUNT(*) as total FROM supplier");
    $jml_supplier = mysqli_fetch_assoc($q2)['total'];
    $q3 = mysqli_query($conn, "SELECT COUNT(*) as total FROM pelanggan");
    $jml_pelanggan = mysqli_fetch_assoc($q3)['total'];
    $q4 = mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi");
    $jml_transaksi = mysqli_fetch_assoc($q4)['total'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home - Dashboard</title>
        <style>
            body {
                margin:0;
                font-family:sans-serif;
                background-color: #f4f7f6;
            }
            .navbar  {
                width:100%;
                background:#333;
                color:white;
                padding:10px;
                display:flex;
                align-items:center;
                box-sizing: border-box;
            }
            .navbar a  {
                color:white;
                margin-right:20px;
                text-decoration:none;
                font-size:18px;
            }
            .navbar a:hover  {
                text-decoration:underline;
            }
            .user-menu  {
                margin-left:auto;
                position:relative;
                cursor:pointer;
                color:white;
                font-size:18px;
            }
            .dropdown  {
                display:none;
                position:absolute;
                right:0;
                background:#444;
                padding:10px;
                border-radius:5px;
                z-index: 100;
            }
            .dropdown a  {
                display:block;
                color:white;
                text-decoration:none;
                padding:5px 10px;
            }
            .dropdown a:hover  {
                background:#555;
            }
            .user-menu:hover .dropdown  {
                display:block;
            }
            .container  {
                max-width:1200px;
                margin:20px auto;
                padding:20px;
            }
            .welcome-box  {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.05);
                margin-bottom: 20px;
                border-left: 5px solid #333;
            }
            .grid-container  {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
            .card  {
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                text-align: center;
                transition: transform 0.2s;
            }
            .card:hover  {
                transform: translateY(-5px);
            }
            .card h3  {
                margin: 0;
                font-size: 36px;
                color: #333;
            }
            .card p  {
                margin: 5px 0 0;
                color: #777;
                font-size: 16px;
                font-weight: bold;
            }
            .border-blue  {
                border-top: 4px solid #3498db;
            }
            .border-green  {
                border-top: 4px solid #27ae60;
            }
            .border-orange  {
                border-top: 4px solid #f39c12;
            }
            .border-red  {
                border-top: 4px solid #e74c3c;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="#">Home</a>
            <?php if($_SESSION['level'] == "Admin"): ?>
            <a href="datamaster/datamaster.php">Data Master</a>
            <?php endif; ?>
            <a href="transaksi/transaksi.php">Transaksi</a>
            <a href="laporan/laporan.php">Laporan</a>
            <div class="user-menu">
                <?= $nama_user ?> (<?= $_SESSION['level'] ?>) ▼
                <div class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="welcome-box">
                <h2 style="margin-top:0;">Selamat Datang, <?= $nama_user ?>!</h2>
                <p>Anda telah login sebagai <strong>Administrator</strong>. Berikut adalah ringkasan data toko Anda hari ini.</p>
            </div>
            <div class="grid-container">
                <div class="card border-blue">
                    <h3><?= $jml_barang ?></h3>
                    <p>Total Barang</p>
                </div>
                <div class="card border-green">
                    <h3><?= $jml_supplier ?></h3>
                    <p>Total Supplier</p>
                </div>
                <div class="card border-orange">
                    <h3><?= $jml_pelanggan ?></h3>
                    <p>Total Pelanggan</p>
                </div>
                <div class="card border-red">
                    <h3><?= $jml_transaksi ?></h3>
                    <p>Total Transaksi</p>
                </div>
            </div>
        </div>
    </body>
</html>