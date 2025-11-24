<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: 0");

    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

    $nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Toko josjis</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./data_master//barang//barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="./data_master//supplier//supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item" href="./data_master//pelanggan//pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item" href="./data_master//user//data_user.php">Data User</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./transaksi/transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./laporan/laporan.php">Laporan</a>
                    </li>
                </ul>
                <span class="navbar-text text-white me-3">
                    👤 <?= $nama; ?>
                </span>
                <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3>Selamat Datang, <?= $nama; ?>!</h3>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>