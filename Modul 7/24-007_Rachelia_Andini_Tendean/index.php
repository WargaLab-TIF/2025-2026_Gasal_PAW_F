<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Data Transaksi</title>

<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f2f4f7;
    margin: 0;
}

.header {
    background: #2b2b2b;
    color: white;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .brand {
    font-size: 18px;
    font-weight: bold;
}

.header .menu a {
    color: white;
    text-decoration: none;
    margin-left: 25px;
    font-size: 15px;
}

.content-box {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}

.subheader {
    background: #0086ff;
    padding: 12px 18px;
    color: white;
    font-weight: bold;
    margin-top: 10px;
}

.inner-box {
    padding: 15px 20px;
    margin-top: 10px;
}

.btn {
    padding: 8px 14px;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    outline: none;
    cursor: pointer;
}

.btn-blue { background: #007bff; }
.btn-green { background: #28a745; }

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.table th {
    background: #f0f3f5;
}

.small { font-size: 13px; }
.right { text-align: right; }

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    color: white;
}

.badge-info { background: #3274caff; }
.badge-danger { background: #e03232ff; }
</style>

</head>
<body>

<div class="header">
    <div class="brand">Penjualan XYZ</div>
    <div class="menu">
        <a href="#">Supplier</a>
        <a href="#">Barang</a>
        <a href="index.php">Transaksi</a>
    </div>
</div>

<div class="content-box">
    <div class="subheader">Data Master Transaksi</div>

    <div class="inner-box">

        <div style="text-align:right; margin-bottom:10px;">
            <a class="btn btn-blue" href="report.php">Lihat Laporan Penjualan</a>
            <a class="btn btn-green" href="#">Tambah Transaksi</a>
        </div>

        <table class="table">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th class="right">Total</th>
                <th>Tindakan</th>
            </tr>

            <?php
            $sqlTransaksi = "
                SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama
                FROM transaksi t
                LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
                ORDER BY t.waktu_transaksi DESC
            ";

            $resultTransaksi = mysqli_query($koneksi, $sqlTransaksi);
            $nomor = 1;

            while ($transaksi = mysqli_fetch_assoc($resultTransaksi)):
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $transaksi['id']; ?></td>
                    <td><?= $transaksi['waktu_transaksi']; ?></td>
                    <td><?= $transaksi['nama']; ?></td>
                    <td class="small"><?= $transaksi['keterangan']; ?></td>
                    <td class="right">Rp<?= number_format($transaksi['total'],0,',','.'); ?></td>
                    <td>
                        <span class="badge badge-info">Detail</span>
                        <span class="badge badge-danger">Hapus</span>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>

    </div>
</div>

</body>
</html>
