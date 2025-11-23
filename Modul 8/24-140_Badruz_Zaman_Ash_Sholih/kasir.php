<?php
session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 2) {
    header("Location: owner.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Dashboard Kasir</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
    body { 
        margin:0; 
        font-family: verdana; 
        background:#f0f2f5; }

    .navbar {
        width:100%;
        background:#20c997;
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

    .navbar a:hover { opacity:0.85; }

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
    .dropdown-content a:hover { background:#f0f0f0; }
    .dropdown:hover .dropdown-content { display:block; }

    .container {
        padding:25px;
    }
</style>
</head>
<body>

    <div class="navbar">
        <div class="nav-left">
            <strong>Sistem Penjualan</strong>
            <a href="kasir.php">Home</a>
            <a href="./transaksi/transaksi.php">Transaksi</a>
            <a href="laporan.php">Laporan</a>
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
        <h2>Dashboard Kasir</h2>
        <p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong></p>
    </div>

</body>
</html>