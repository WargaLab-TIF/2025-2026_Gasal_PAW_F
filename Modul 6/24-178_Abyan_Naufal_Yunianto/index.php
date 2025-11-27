<?php 
    include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Master Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Pengelolaan Master Detail Transaksi</h1>
    <h2> Data Barang</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
            $q = $koneksi->query("SELECT * FROM barang");
            while ($r = $q->fetch_assoc()) {
                echo "<tr>
                <td>{$r['id']}</td>
                <td>{$r['nama_barang']}</td>
                <td>Rp" . number_format($r['harga'],0,',','.') . "</td>
                <td>{$r['stok']}</td>
                <td><a href='hapus_barang.php?id={$r['id']}'
                onclick='return confirm(\"Yakin mau hapus?\")'>Hapus</a></td>
                </tr>";
            }
        ?>
    </table>
    <h2> Data Transaksi</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Pelanggan</th>
            <th>Total</th>
        </tr>
        <?php
            $q = $koneksi->query("SELECT t.*, p.nama AS pelanggan FROM transaksi t JOIN pelanggan p ON t.pelanggan_id=p.id");
            while ($r = $q->fetch_assoc()) {
                echo "<tr>
                <td>{$r['id']}</td>
                <td>{$r['waktu_transaksi']}</td>
                <td>{$r['keterangan']}</td>
                <td>{$r['pelanggan']}</td>
                <td>Rp" . number_format($r['total'],0,',','.') . "</td>
                </tr>";
            }
        ?>
    </table>
    <h2> Data Detail Transaksi</h2>
    <table border="1">
        <tr>
            <th>ID Transaksi</th>
            <th>Barang</th>
            <th>Qty</th>
            <th>Harga</th>
        </tr>
        <?php
            $q = $koneksi->query("SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.barang_id=b.id");
            while ($r = $q->fetch_assoc()) {
                echo "<tr>
                <td>{$r['transaksi_id']}</td>
                <td>{$r['nama_barang']}</td>
                <td>{$r['qty']}</td>
                <td>Rp" . number_format($r['harga'],0,',','.') . "</td>
                </tr>";
            }
        ?>
    </table>
    <div class="menu">
        <a href="tambah_transaksi.php" class="btn-tambah">Tambah Transaksi</a>
        <a href="tambah_detail_transaksi.php" class="btn-tambah"> Tambah Detail Transaksi</a>
    </div>
</body>
</html>