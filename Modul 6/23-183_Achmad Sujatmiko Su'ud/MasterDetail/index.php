<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="sidebar">
  <h2>Menu Utama</h2>
  <a href="index.php" class="active">Dashboard</a>
  <a href="pages/barang.php">Barang</a>
  <a href="pages/transaksi.php">Transaksi</a>
  <a href="pages/transaksi_detail.php">Transaksi Detail</a>
  <div class="logout">
    <a href="#" style="color:white;text-decoration:none;">Logout</a>
  </div>
</div>

<div class="main-content">
  <h1>Selamat Datang di Sistem Pengelolaan Master Detail</h1>
  <p>Gunakan menu di sidebar untuk mengelola Barang, Transaksi, dan Transaksi Detail.</p>
</div>

</body>
</html>
