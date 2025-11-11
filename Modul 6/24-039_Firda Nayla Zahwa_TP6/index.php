<?php
require_once "koneksi.php";
$barang = mysqli_query($conn, "SELECT * FROM barang");
$transaksi = mysqli_query($conn, "
    SELECT t.*, p.nama AS nama_pelanggan
    FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
");
$detail = mysqli_query($conn, "
    SELECT td.transaksi_id, b.nama_barang, td.qty, td.harga
    FROM transaksi_detail td
    JOIN barang b ON td.barang_id = b.id
    ORDER BY td.transaksi_id
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            margin: 20px;
        }
        h2 {
            margin-bottom: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background: #e4e4e4;
        }
        .flex {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .box {
            flex: 1;
        }
        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
        }
        .btn:hover {
            background: #1e40af;
        }
    </style>
</head>
<body>

    <h2>Data Barang</h2>
    <table>
        
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($b = mysqli_fetch_assoc($barang)): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['nama_barang'] ?></td>
            <td><?= number_format($b['harga']) ?></td>
            <td><?= $b['stok'] ?></td>
            <td>
                <a href="hapus_barang.php?id=<?= $b['id'] ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="flex">
        <div class="box">
            <h2>Data Transaksi</h2>
            <table>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Waktu Transaksi</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Pelanggan</th>
                </tr>
                <?php while ($t = mysqli_fetch_assoc($transaksi)): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= $t['waktu_transaksi'] ?></td>
                    <td><?= $t['keterangan'] ?></td>
                    <td><?= number_format($t['total']) ?></td>
                    <td><?= $t['nama_pelanggan'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>

            <a href="tambah_transaksi.php" class="btn">Tambah Transaksi</a>
            <a href="tambah_detail.php" class="btn">Tambah Transaksi Detail</a>
        </div>
        <div class="box">
            <h2>Data Detail Transaksi</h2>
            <table>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                </tr>
                <?php while ($d = mysqli_fetch_assoc($detail)): ?>
                <tr>
                    <td><?= $d['transaksi_id'] ?></td>
                    <td><?= $d['nama_barang'] ?></td>
                    <td><?= $d['qty'] ?></td>
                    <td><?= number_format($d['harga']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
