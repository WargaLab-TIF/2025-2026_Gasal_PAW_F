<?php
session_start(); 
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}

$sql = "SELECT * FROM transaksi ORDER BY id_transaksi ASC";
$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        .navbar {
            background-color: #343a40;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            color: #ffffff;
            font-size: 1.25rem;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar-nav {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav-item {
            margin-left: 15px; 
        }
        .nav-link {
            color: #ffffff;
            text-decoration: none;
        }
        .container-fluid {
            padding: 20px;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-bar {
            background-color: #007bff; 
            color: white;
            padding: 10px 15px;
            font-size: 1.25rem;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .card-body {
            padding: 20px;
        }
        .mb-3 {
            margin-bottom: 16px;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            border: 1px solid transparent;
            color: white;
            white-space: nowrap; 
        }
        .btn-lihat-laporan {
            background-color: #007bff; 
            border-color: #007bff;
        }
        .btn-tambah {
            background-color: #28a745; 
            border-color: #28a745;
        }
        .btn-info {
            background-color: #17a2b8; 
            border-color: #17a2b8;
            padding: 4px 8px; 
            font-size: 12px;
        }
        .btn-danger {
            background-color: #dc3545; 
            border-color: #dc3545;
            padding: 4px 8px; 
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table thead {
            background-color: #e9ecef; 
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: rgba(0,0,0,0.05); 
        }
    </style>
</head>
<body>
    <nav class="navbar">
      <a class="navbar-brand" href="index.php">Penjualan XYZ</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="data_supplier.php">Supplier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="data_barang.php">Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaksi.php">Transaksi</a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
        <div class="card">
            <div class="header-bar">Data Master Transaksi</div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="index.php" class="btn" style="background:#6c757d;">&lt; Dashboard</a>
                    <a href="laporan.php" class="btn btn-lihat-laporan">Lihat Laporan Penjualan</a>
                    <a href="#" class="btn btn-tambah">Tambah Transaksi</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1; 
                        while ($data = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['id_transaksi']; ?></td>
                            <td><?= $data['waktu_transaksi']; ?></td>
                            <td><?= $data['nama_pelanggan']; ?></td>
                            <td><?= $data['keterangan']; ?></td>
                            <td>Rp<?= number_format($data['total'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="#" class="btn btn-info">Lihat Detail</a>
                                <a href="#" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>