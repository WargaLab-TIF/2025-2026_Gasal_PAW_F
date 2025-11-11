<?php
    include "conn.php";
    include "hapus.php";

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
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
            font-family: Arial, sans-serif;
        }
        h3 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .card-header {
            font-weight: bold;
        }
        a {
            text-decoration: none;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn a {
            color: white;
            text-decoration: none;
        }
        .btn a:hover {
            color: white;
        }
    </style>
</head>
<body>

<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Data Barang</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Nama Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_barang)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['stok']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td>
                                <a href="?hapus=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?');">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Data Transaksi</h3>
                    <button class="btn btn-light btn-sm">
                        <a href="tambah_transaksi_form.php" class="text-success fw-bold">+ Tambah Transaksi</a>
                    </button>
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
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Transaksi</h3>
                    <button class="btn btn-light btn-sm">
                        <a href="tambah_detail_form.php" class="text-warning fw-bold">+ Tambah Detail</a>
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
                                        <a href="./proses/hapus_detail.php?transaksi_id=<?= $row['transaksi_id'] ?>&barang_id=<?= $row['barang_id'] ?>"
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

</body>
</html>
