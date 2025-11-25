<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

$data_transaksi = mysqli_query($koneksi, 
    "SELECT t.*, p.nama 
     FROM transaksi t 
     LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
     ORDER BY t.id ASC"); 

$data_transaksi_detail = mysqli_query($koneksi, 
    "SELECT td.*, b.nama_barang 
     FROM transaksi_detail td
     LEFT JOIN barang b ON td.barang_id = b.id
     ORDER BY td.transaksi_id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        body {
            background: #f5f5f5;
            font-family: Arial;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0274bd; 
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .btn {
            padding: 8px 12px;
            background: #0274bd;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .btn:hover {
            background: #005a91;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #0274bd;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .box {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 5px;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="box">
        <h2>Data Master Transaksi</h2>

        <a href="tambah_transaksi.php" class="btn">+ Tambah Transaksi</a>

        <table>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
            </tr>

            <?php 
            $no = 1;
            while ($t = mysqli_fetch_assoc($data_transaksi)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($t['id']) ?></td>
                <td><?= htmlspecialchars($t['waktu_transaksi']) ?></td>
                <td><?= htmlspecialchars($t['nama'] ?? 'Umum') ?></td>
                <td><?= htmlspecialchars($t['keterangan'] ?? '-') ?></td>
                <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>

    <div class="box">
        <h2>Data Master Transaksi Detail</h2>

        <a href="tambah_transaksi_detail.php" class="btn">+ Tambah Transaksi Detail</a>

        <table>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                </tr>

            <?php 
            $no = 1;
            while ($td = mysqli_fetch_assoc($data_transaksi_detail)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($td['transaksi_id']) ?></td>
                <td><?= htmlspecialchars($td['nama_barang']) ?></td>
                <td>Rp <?= number_format($td['harga'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($td['qty']) ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>