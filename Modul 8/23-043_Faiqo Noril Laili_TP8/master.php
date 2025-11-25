<?php include 'koneksi.php'; ?>
<link rel="stylesheet" href="style.css">

<h2>Data Barang</h2>
<a href="barang_tambah.php">+ Tambah Barang</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php
    $barang = mysqli_query($koneksi, "SELECT * FROM barang");
    while ($b = mysqli_fetch_assoc($barang)) {
        echo "<tr>
                <td>{$b['id']}</td>
                <td>{$b['nama_barang']}</td>
                <td>Rp" . number_format($b['harga'], 0, ',', '.') . "</td>
                <td>{$b['stok']}</td>
                <td>
                    <a href='barang_hapus.php?id={$b['id']}' onclick='return confirm(\"Yakin ingin menghapus barang ini?\")'>Hapus</a>
                </td>
              </tr>";
    }
    ?>
</table>

<hr>

<h2>Data Transaksi</h2>
<a href="transaksi_tambah.php">+ Tambah Transaksi</a>
<a href="report_transaksi.php">Lihat Laporan Penjualan</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Pelanggan</th>
        <th>Total</th>
    </tr>
    <?php
    $transaksi = mysqli_query($koneksi, "
        SELECT t.*, p.nama AS nama_pelanggan 
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    ");
    while ($t = mysqli_fetch_assoc($transaksi)) {
        echo "<tr>
                <td>{$t['id']}</td>
                <td>{$t['waktu_transaksi']}</td>
                <td>{$t['keterangan']}</td>
                <td>{$t['nama_pelanggan']}</td>
                <td>Rp" . number_format($t['total'], 0, ',', '.') . "</td>
              </tr>";
    }
    ?>
</table>

<hr>

<h2>Data Detail Transaksi</h2>
<a href="transaksi_detail_tambah.php">+ Tambah Detail Transaksi</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID Transaksi</th>
        <th>Barang</th>
        <th>Qty</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
    </tr>
    <?php
    $detail = mysqli_query($koneksi, "
        SELECT td.*, b.nama_barang, b.harga 
        FROM transaksi_detail td
        JOIN barang b ON td.barang_id = b.id
    ");
    while ($d = mysqli_fetch_assoc($detail)) {
        echo "<tr>
                <td>{$d['transaksi_id']}</td>
                <td>{$d['nama_barang']}</td>
                <td>{$d['qty']}</td>
                <td>Rp" . number_format($d['harga'], 0, ',', '.') . "</td>
                <td>Rp" . number_format($d['subtotal'], 0, ',', '.') . "</td>
              </tr>";
    }
    ?>
</table>
