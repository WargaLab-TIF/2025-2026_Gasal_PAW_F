<?php

$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


$transaksi = mysqli_query($conn, "
    SELECT t.*, p.nama AS nama_pelanggan
    FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }

        h2 {
            margin-bottom: 10px;
        }

        a.btn {
            display: inline-block;
            padding: 8px 14px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
            margin-bottom: 15px;
        }

        a.btn:hover {
            background: #1d4ed8;
        }

        a.btn-green {
            background: #22c55e;
        }
        a.btn-green:hover {
            background: #15803d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table th {
            background: #e5e7eb;
            padding: 10px;
            border: 1px solid #ccc;
        }

        table td {
            padding: 10px;
            border: 1px solid #ccc;
            background: #fff;
        }

        table tr:nth-child(even) td {
            background: #f9fafb;
        }

        .action a {
            margin-right: 5px;
            text-decoration: none;
            color: #2563eb;
        }

        .action a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

<h2>Data Master Transaksi</h2>


<a href="report_transaksi.php" class="btn">Lihat Laporan Penjualan</a>
<a href="tambah_transaksi.php" class="btn btn-green">Tambah Transaksi</a>

<table>
    <tr>
        <th>No</th>
        <th>ID Transaksi</th>
        <th>Waktu Transaksi</th>
        <th>Nama Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Tindakan</th>
    </tr>

    <?php 
    $no = 1;
    while ($row = mysqli_fetch_assoc($transaksi)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['waktu_transaksi'] ?></td>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td class="action">
                <a href="detail_transaksi.php?id=<?= $row['id'] ?>">Detail</a>
                <a href="hapus_transaksi.php?id=<?= $row['id'] ?>">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
