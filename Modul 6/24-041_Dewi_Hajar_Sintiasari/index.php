<?php
include 'koneksi.php';

$transaksi = mysqli_query($conn, 
    "SELECT t.id, t.waktu_transaksi, t.keterangan, 
            IFNULL(SUM(d.qty * d.harga),0) AS total, 
            p.nama AS pelanggan
     FROM transaksi t
     LEFT JOIN transaksi_detail d ON t.id = d.transaksi_id
     JOIN pelanggan p ON t.pelanggan_id = p.id
     GROUP BY t.id");

$detail = mysqli_query($conn, 
    "SELECT d.transaksi_id, b.nama_barang, d.harga, d.qty
     FROM transaksi_detail d
     JOIN barang b ON d.barang_id = b.id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Data</title>
<script>
    function confirmDelete(barang_id) {
        if (confirm("Anda yakin ingin menghapus barang ini?")) {
        window.location.href = 'hapus_barang.php?id_barang=' + barang_id;
        }
    }
</script>

<style>
    body {
        padding: 0px 10px;
    }
    th, td { 
        padding:6px; 
        text-align: center;
    }
</style>
</head>
<body>

<?php include 'hapus_barang.php'; ?>

<hr>

<h2>Data Transaksi</h2>

<table border="1" cellpadding="6" width="100%">
<tr>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th>Total</th>
    <th>Pelanggan</th>
</tr>
<?php while($transaksi_data = mysqli_fetch_assoc($transaksi)) : ?>
<tr>
    <td><?= $transaksi_data['id']; ?></td>
    <td><?= $transaksi_data['waktu_transaksi']; ?></td>
    <td><?= $transaksi_data['keterangan']; ?></td>
    <td><?= number_format($transaksi_data['total'],0,',','.'); ?></td>
    <td><?= $transaksi_data['pelanggan']; ?></td>
</tr>
<?php endwhile; ?>
</table>

<hr>

<h2>Data Detail Transaksi</h2>
<table border="1" cellpadding="6" width="100%">
<tr>
    <th>ID Transaksi</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Qty</th>
</tr>
<?php while($data_det_transakasi = mysqli_fetch_assoc($detail)) : ?>
<tr>
    <td><?= $data_det_transakasi['transaksi_id']; ?></td>
    <td><?= $data_det_transakasi['nama_barang']; ?></td>
    <td><?= number_format($data_det_transakasi['harga'] ,0,',','.'); ?></td>
    <td><?= $data_det_transakasi['qty']; ?></td>
</tr>
<?php endwhile; ?>

</table>
<br>
<a href="tambah_transaksi.php">Tambah Transaksi</a>
<a href="tambah_detailtransaksi.php?">Tambah Detail Transaksi</a>

</body>
</html>