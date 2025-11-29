<?php
session_start();
include "koneksi.php"; 

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$transaksiData = mysqli_query($koneksi, "
    SELECT t.*, p.nama AS pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    ORDER BY t.id ASC
");

$detailData = mysqli_query($koneksi, "
    SELECT d.*, b.nama_barang
    FROM transaksi_detail d
    JOIN barang b ON d.barang_id = b.id
    ORDER BY d.transaksi_id ASC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .box { background: #fff; padding: 15px; border-radius: 10px; margin: 20px auto; box-shadow: 0 2px 6px rgba(0,0,0,0.1); max-width: 1200px; }
        h3 { margin-bottom: 8px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #007bff; color: #fff; }
        a { text-decoration: none; color: #fff; padding: 5px 10px; border-radius: 5px; }
        .btn-add { background: #28a745; margin-bottom: 10px; display: inline-block; }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?> 
    
    <div class="box">
        <h3>Data Transaksi</h3>
        <a href="tambah_transaksi.php" class="btn-add">+ Tambah Transaksi</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Pelanggan</th>
                <th>Total</th>
            </tr>
            <?php if (mysqli_num_rows($transaksiData) > 0): 
                while ($trx = mysqli_fetch_assoc($transaksiData)):
            ?>
            <tr>
                <td><?= $trx['id']; ?></td>
                <td><?= date('d/m/Y', strtotime($trx['waktu_transaksi'])); ?></td>
                <td><?= $trx['keterangan']; ?></td>
                <td><?= $trx['pelanggan'] ?? '-'; ?></td>
                <td>Rp<?= number_format($trx['total'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="5">Belum ada data transaksi</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="box">
        <h3>Detail Transaksi</h3>
        <a href="tambah_detail.php" class="btn-add">+ Tambah Detail Transaksi</a>
        <table>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Total</th>
            </tr>
            <?php if (mysqli_num_rows($detailData) > 0): 
                while ($det = mysqli_fetch_assoc($detailData)):
            ?>
            <tr>
                <td><?= $det['transaksi_id']; ?></td>
                <td><?= $det['nama_barang']; ?></td>
                <td><?= $det['qty']; ?></td>
                <td>Rp<?= number_format($det['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="4">Belum ada detail transaksi</td></tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>