<?php
session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 1) {
    header("Location: kasir.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard Owner</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body { 
            margin:0; 
            font-family: verdana; 
            background:#f0f2f5; }

        .navbar {
            width:100%;
            background:#007bff;
            color:#fff;
            padding:14px 22px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            box-sizing:border-box;
        }

        .nav-left, .nav-right { display:flex; align-items:center; gap:20px; }

        .navbar a {
            color:#fff;
            text-decoration:none;
            font-size:15px;
        }

        .navbar a:hover { opacity:0.8; }

        .dropdown { position:relative; }
        .dropdown-content {
            display:none;
            position:absolute;
            background:#fff;
            min-width:150px;
            right:0;
            border-radius:6px;
            box-shadow:0 2px 10px rgba(0,0,0,.2);
            overflow:hidden;
            z-index:99;
        }
        .dropdown-content a {
            color:#333 !important;
            padding:10px 12px;
            display:block;
            text-decoration:none;
        }
        .dropdown-content a:hover {
            background:#f0f0f0;
        }
        .dropdown:hover .dropdown-content { display:block; }

        .container { padding:25px; }
        h2 { margin-top:0; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="nav-left">
            <strong>Sistem Penjualan</strong>
            <a href="owner.php">Home</a>

            <div class="dropdown">
                <a href="#">Data Master ▾</a>
                <div class="dropdown-content">
                    <a href="./data-master/data_barang.php">Data Barang</a>
                    <a href="./data-master/data_supplier.php">Data Supplier</a>
                    <a href="./data-master/data_pelanggan.php">Data Pelanggan</a>
                    <a href="./data-master/data_user.php">Data User</a>
                </div>
            </div>

            <a href="./transaksi/transaksi.php">Transaksi</a>
            <a href="./laporan/laporan_transaksi_print.php">Laporan</a>
        </div>

        <div class="nav-right">
            <div class="dropdown">
                <a href="#">
                    <?php echo htmlspecialchars($_SESSION['user']); ?> ▾
                </a>
                <div class="dropdown-content">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Dashboard Owner</h2>
        <p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong></p>
    </div>

</body>
</html>