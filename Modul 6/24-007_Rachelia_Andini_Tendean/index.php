<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Master Detail Transaksi</title>
<style>
    body { font-family: Arial; background: #f5f5f5; padding: 20px; }
    h2 { text-align: center; background: #007bff; color: #fff; padding: 10px; border-radius: 5px; }
    h3 { margin-bottom: 8px; color: #333; }
    .box { background: #fff; padding: 15px; border-radius: 10px; margin: 20px 0; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    th { background: #007bff; color: #fff; }
    tr:hover { background: #f1f1f1; }
    a { text-decoration: none; color: #fff; padding: 5px 10px; border-radius: 5px; }
    .btn-add { background: #28a745; margin-bottom: 10px; display: inline-block; }
    .btn-add:hover { background: #218838; }
    .btn-del { background: #dc3545; }
    .btn-del:hover { background: #c82333; }
</style>
</head>
<body>

<h2>Pengelolaan Master Detail Transaksi</h2>

<div class="box">
<h3>Data Barang</h3>
<table>
<tr>
    <th>ID</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Supplier</th>
    <th>Aksi</th>
</tr>
<?php
$barangData = mysqli_query($conn, "
    SELECT b.*, s.nama AS supplier
    FROM barang b
    JOIN supplier s ON b.supplier_id = s.id
    ORDER BY b.id ASC
");
if (mysqli_num_rows($barangData) > 0):
    while ($row = mysqli_fetch_assoc($barangData)):
?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['kode_barang']; ?></td>
    <td><?= $row['nama_barang']; ?></td>
    <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
    <td><?= $row['stok']; ?></td>
    <td><?= $row['supplier']; ?></td>
    <td>
        <a href="hapus_barang.php?id=<?= $row['id']; ?>" class="btn-del" onclick="return confirm('Yakin hapus barang ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; else: ?>
<tr><td colspan="7">Belum ada data barang</td></tr>
<?php endif; ?>
</table>
</div>

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
<?php
$transaksiData = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    ORDER BY t.id ASC
");
if (mysqli_num_rows($transaksiData) > 0):
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
<?php
$detailData = mysqli_query($conn, "
    SELECT d.*, b.nama_barang
    FROM transaksi_detail d
    JOIN barang b ON d.barang_id = b.id
    ORDER BY d.transaksi_id ASC
");
if (mysqli_num_rows($detailData) > 0):
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
