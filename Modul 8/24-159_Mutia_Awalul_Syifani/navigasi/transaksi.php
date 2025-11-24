<?php
include '../koneksi.php';

$sql = "SELECT * FROM transaksi ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-primary { background: #007bff; }
        .btn-success { background: #28a745; }
        .btn-info { background: #110d81ff; }
        .btn-danger { background: #dc3545; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background: #eaeaea;
            padding: 10px;
            border: 1px solid #ccc;
        }

        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>

<body>

<div class="container">

    <h3>Data Master Transaksi</h3>

    <div style="margin-bottom: 15px;">
        <a href="tambah_transaksi.php" class="btn btn-success">Tambah Transaksi</a>
    </div>

    <table>
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
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['waktu_transaksi'] ?></td>
                <td><?= $row['pelanggan_id'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                <td>
                    <a href="detail_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                    <a href="hapus_transaksi.php?id=<?= $row['id'] ?>" 
                       onclick="return confirm('Yakin ingin menghapus?')" 
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>

</div>

</body>
</html>
