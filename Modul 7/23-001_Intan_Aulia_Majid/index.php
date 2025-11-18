<?php

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penjualan XYZ</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Transaksi</a></li>
                </ul>
            </div>
        </div>
    </nav>

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