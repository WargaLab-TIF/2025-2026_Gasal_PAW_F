<?php
session_start();
require_once "conn.php";
if(!isset($_SESSION['login']) || $_SESSION['login'] !== true ){
    header("Location: login.php");
    exit();
}

if ($_SESSION['level'] == '1') {
    $dataMaster=True;
}else{
    $dataMaster=False;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM PENJUALAN</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/datamaster.css">
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li class="main-item">
                <a></i> Sistem Penjualan</a>
            </li>

            <li><a href="index.php">Home</a></li>
            <?php
            if($dataMaster){
                echo "<li class='dropdown'>
                        <a>Data Master</a> 
                        <div class='dropdown-content'>
                            <a href='index.php?page=pelanggan'>Data Pelanggan</a>
                            <a href='index.php?page=barang'>Data Barang</a>
                            <a href='index.php?page=supplier'>Data Supplier</a>
                            <a href='index.php?page=user'>Data User</a>
                        </div>
                    </li>";
            }
            ?>
            <li><a href="index.php?page=transaksi">Transaksi</a></li>

            <li><a href="index.php?page=laporan">Laporan</a></li>

            <li class="dropdown right-aligned">
                <a><?=$_SESSION['username']?></a>
                <div class="dropdown-content">
                    <a href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="main-content">
        <?php
            if (isset($_SESSION['crud_pesan'])) {
                echo "<div class='alert' style='background: #fff3cd; color: #856404; padding: 10px; margin-bottom: 10px; border: 1px solid #ffeeba; border-radius: 4px;'>" . $_SESSION['crud_pesan'] . "</div>";
                unset($_SESSION['crud_pesan']);
            }

            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                $allowed = ["pelanggan", "barang", "supplier", "transaksi","laporan","user","barang","pelanggan","supplier","transaksi_detail_proses"];

                if (in_array($page, $allowed)) {
                    include "./pages/$page.php";
                } else {
                    echo "<h2>Halaman tidak ditemukan.</h2>";
                }
            } else {
                echo "<div class=container><h2>Selamat Datang di Sistem Penjualan/ mohammad elghifary</h2></div>";
            }
        ?>
    </div>
</body>
</html>