<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil data transaksi
$sql = mysqli_query($koneksi, "
    SELECT 
        transaksi.id,
        transaksi.waktu_transaksi,
        transaksi.keterangan,
        transaksi.total,
        pelanggan.nama AS nama_pelanggan
    FROM transaksi
    LEFT JOIN pelanggan ON pelanggan.id = transaksi.pelanggan_id
    ORDER BY transaksi.id ASC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        .menu {
            margin-bottom: 15px;
        }

        .menu a {
            padding: 8px 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }

        .menu a:hover {
            background: #005fcc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border: 1px solid #ccc; /* border luar warna abu */
        }

        th, td {
            border: 1px solid #ccc; /* border kolom abu */
            padding: 8px;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        /* Tombol Aksi */
        .aksi a {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 3px;
            text-decoration: none;
            color: white;
        }

        .btn-detail {
            background: #17a2b8;
        }

        .btn-detail:hover {
            background: #0d6e7f;
        }

        .btn-hapus {
            background: #dc3545;
        }

        .btn-hapus:hover {
            background: #a71d2a;
        }

    </style>

</head>
<body>

<h2>Data Transaksi</h2>

<div class="menu">
    <a href="report_transaksi.php">Lihat Laporan Penjualan</a>
    <a href="tambah_transaksi.php" style="background:#28a745;">Tambah Transaksi</a>
</div>

<table>
    <tr>
        <th>No</th>
        <th>ID Transaksi</th>
        <th>Waktu</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($sql)) {
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['waktu_transaksi'] ?></td>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td>Rp<?= number_format($row['total']) ?></td>
            <td class="aksi">
                <a class="btn-detail" href="transaksi_detail.php?id=<?= $row['id'] ?>">Detail</a>
                <a class="btn-hapus"
                   href="hapus.php?id=<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
