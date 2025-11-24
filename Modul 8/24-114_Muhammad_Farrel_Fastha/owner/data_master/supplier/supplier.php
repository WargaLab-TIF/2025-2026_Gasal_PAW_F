<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
}
$nama = $_SESSION['nama'];

$stmt_select = mysqli_prepare($conn, "SELECT id, nama, telp, alamat FROM supplier");
mysqli_stmt_execute($stmt_select);
$result_supplier = mysqli_stmt_get_result($stmt_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
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
                    <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">
                        Data Master
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/barang/barang.php">Data Barang</a></li>
                        <li><a class="dropdown-item active" href="supplier.php">Data Supplier</a></li>
                        <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/pelanggan/pelanggan.php">Data Pelanggan</a></li>
                        <li><a class="dropdown-item" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/data_master/user/data_user.php">Data User</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/transaksi/transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link" href="/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/laporan/laporan.php">Laporan</a></li>
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
                    <h4 class="mb-0">Daftar Supplier</h4>
                    <a href="./tambah.php" class="btn btn-warning btn-sm">+ Tambah Supplier</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Supplier</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($data = mysqli_fetch_assoc($result_supplier)): ?>
                                <tr>
                                    <td><?= $data['id'] ?></td>
                                    <td><?= htmlspecialchars($data['nama']) ?></td>
                                    <td><?= htmlspecialchars($data['telp']) ?></td>
                                    <td><?= htmlspecialchars($data['alamat']) ?></td>
                                    <td>
                                        <a href="./edit.php?id=<?= $data['id']; ?>" class="btn btn-success btn-sm">Edit</a>

                                        <a href="./hapus.php?id=<?= $data['id']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Yakin ingin menghapus data supplier ini?');">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
