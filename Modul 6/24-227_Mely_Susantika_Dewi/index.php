<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #666;
            padding: 6px 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-hapus, .btn-tambah {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
        .btn-hapus {
            background-color: red;
        }
        .btn-hapus:hover {
            background-color: darkred;
        }
        .btn-tambah {
            background-color: green;
        }
        .btn-tambah:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
<h3>Data Barang</h3>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Aksi</th>
</tr>
<?php
$data = mysqli_query($koneksi, "SELECT * FROM barang");
while ($d = mysqli_fetch_assoc($data)) {
    echo "<tr>
        <td>{$d['id']}</td>
        <td>{$d['nama_barang']}</td>
        <td>{$d['harga']}</td>
        <td>{$d['stok']}</td>
        <td><a class='btn-hapus' href='hapus_barang.php?id={$d['id']}' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a></td>
    </tr>";
}
?>
</table>

<h3>Data Transaksi</h3>
<a class="btn-tambah" href="tambah_transaksi.php">Tambah Transaksi</a><br>
<br>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th><th>Tanggal</th><th>Keterangan</th><th>Total</th><th>Pelanggan</th>
</tr>
<?php
$q = mysqli_query($koneksi, "SELECT t.*, p.nama AS pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id=p.id");
while ($r = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>{$r['id']}</td>
        <td>{$r['waktu_transaksi']}</td>
        <td>{$r['keterangan']}</td>
        <td>{$r['total']}</td>
        <td>{$r['pelanggan']}</td>
    </tr>";
}
?>
</table>

<h3>Data Detail Transaksi</h3>
<a class="btn-tambah" href="tambah_detail_transaksi.php">Tambah Detail Transaksi</a><br>
<br>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID Transaksi</th><th>Barang</th><th>Harga</th><th>Qty</th>
</tr>
<?php
$dt = mysqli_query($koneksi, "SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON td.barang_id=b.id");
while ($t = mysqli_fetch_assoc($dt)) {
    echo "<tr>
        <td>{$t['transaksi_id']}</td>
        <td>{$t['nama_barang']}</td>
        <td>{$t['harga']}</td>
        <td>{$t['qty']}</td>
    </tr>";
}
?>
</table>
</body>
</html>
