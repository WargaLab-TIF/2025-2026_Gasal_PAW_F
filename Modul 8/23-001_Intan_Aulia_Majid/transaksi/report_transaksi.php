<?php
include "../auth.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan - Penjualan XYZ</title>
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
            <a href="admin.php">Sistem Penjualan</a>
            <a href="admin.php">Home</a>

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
            <a href="#">Laporan</a>
        </div>

        <div class="nav-right">
            <?= $_SESSION['nama']?>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Rekap Laporan Penjualan</h5>
            </div>
            <div class="card-body">
                <a href="index.php" class="btn btn-secondary mb-3">&lt; Kembali</a>
                
                <form action="report_hasil.php" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="tgl_mulai" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="2023-11-08">
                        </div>
                        <div class="col-md-5">
                            <label for="tgl_selesai" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="2023-11-14">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Tampilkan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

