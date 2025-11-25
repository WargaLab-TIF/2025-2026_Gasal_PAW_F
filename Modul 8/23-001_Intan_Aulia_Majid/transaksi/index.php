<?php
include "../auth.php";
include "koneksi.php";

$sql = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, t.pelanggan_id, p.nama FROM transaksi AS t JOIN pelanggan AS p ON t.pelanggan_id = p.id";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan XYZ</title>
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

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }

        .dropbtn:hover {
            text-decoration: underline;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #34495e;
            min-width: 160px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            overflow: hidden;
            z-index: 10;
        }

        .dropdown-content a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 14px;
        }

        .dropdown-content a:hover {
            background-color: #2c3e50;
        }

        /* Muncul saat hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        .nav-right {
            font-weight: bold;
            font-size: 16px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="navbar">
        <div class="nav-left">
            <a href="../admin.php">Sistem Penjualan</a>
            <a href="../admin.php">Home</a>

            <!-- DROPDOWN -->
            <div class="dropdown">
                <button class="dropbtn">Data Master</button>
                <div class="dropdown-content">
                    <a href="../barang.php">Data Barang</a>
                    <a href="../supplier.php">Data Supplier</a>
                    <a href="../pelanggan.php">Data Pelanggan</a>
                    <a href="../user.php">Data User</a>
                </div>
            </div>

            <a href="index.php">Transaksi</a>
            <a href="report_transaksi.php">Laporan</a>
        </div>

        <div class="nav-right">
            <?= $_SESSION['nama']?>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Master Transaksi</h5>
                    <div>
                        <a href="report_transaksi.php" class="btn btn-light">Lihat Laporan Penjualan</a>
                        <a href="#" class="btn btn-success">Tambah Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
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
                        <?php foreach ($data as $index => $transaksi): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $transaksi['id'] ?></td>
                            <td><?= $transaksi['waktu_transaksi'] ?></td>
                            <td><?= $transaksi['nama'] ?></td>
                            <td><?= $transaksi['keterangan'] ?></td>
                            <td><?= $transaksi['total'] ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Lihat Detail</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>