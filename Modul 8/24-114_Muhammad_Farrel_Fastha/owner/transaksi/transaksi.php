<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$nama = $_SESSION['nama'];

$stmt_select = mysqli_prepare($conn, "SELECT b.id, b.nama_barang, b.harga, b.stok, s.nama
    FROM barang AS b
    JOIN supplier AS s ON b.supplier_id = s.id");
    mysqli_stmt_execute($stmt_select);
    $result_barang = mysqli_stmt_get_result($stmt_select);

$stmt_select = mysqli_prepare($conn, "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama
    FROM transaksi AS t
    JOIN pelanggan AS p ON t.pelanggan_id = p.id");
    mysqli_stmt_execute($stmt_select);
    $result_transaksi = mysqli_stmt_get_result($stmt_select);


$stmt_select = mysqli_prepare($conn, "SELECT td.transaksi_id,td.barang_id, b.nama_barang, td.harga, td.qty
    FROM transaksi_detail AS td
    JOIN barang AS b ON td.barang_id = b.id");
    mysqli_stmt_execute($stmt_select);
    $result_transaksi_detail = mysqli_stmt_get_result($stmt_select);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Master Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/barang/barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/supplier/supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/pelanggan/pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/user/data_user.php">Data User</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/laporan/laporan.php">Laporan</a>
                    </li>
                </ul>
                <span class="navbar-text text-white me-3">
                    👤 <?= $nama; ?>
                </span>
                <a href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex justify-content-between">
                            <h4 class="mb-0">Daftar Transaksi</h4>
                            <a href="./tambah_transaksi.php" class="btn btn-warning btn-sm">+ Tambah Transaksi</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-success">
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Keterangan</th>
                                        <th>Total</th>
                                        <th>Nama Pelanggan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result_transaksi)): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']) ?></td>
                                            <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
                                            <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                            <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                                            <td><?= htmlspecialchars($row['nama']) ?></td>   
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Transaksi</h3>
                    <button class="btn btn-light btn-sm">
                        <a href="tambah_detail.php" class="text-warning fw-bold">+ Tambah Detail</a>
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-warning">
                            <tr>
                                <th>Transaksi ID</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_transaksi_detail)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['transaksi_id']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($row['qty']) ?></td>
                                    <td>
                                        <a href="./hapus_detail.php?transaksi_id=<?= $row['transaksi_id'] ?>&barang_id=<?= $row['barang_id'] ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Yakin ingin menghapus detail ini?');">
                                           Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


