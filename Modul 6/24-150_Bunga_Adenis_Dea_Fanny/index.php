<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Index</title>
</head>
<body>

<h2>Daftar Barang</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Supplier ID</th>
    <th>Aksi</th>
</tr>
<?php
// Barang
$result = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id");
while ($r = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($r['id']) . "</td>";
    echo "<td>" . htmlspecialchars($r['kode_barang']) . "</td>";
    echo "<td>" . htmlspecialchars($r['nama_barang']) . "</td>";
    echo "<td>" . htmlspecialchars($r['harga']) . "</td>";
    echo "<td>" . htmlspecialchars($r['stok']) . "</td>";
    echo "<td>" . htmlspecialchars($r['supplier_id']) . "</td>";
    echo "<td><a href='hapus_barang.php?id=" . urlencode($r['id']) . "' onclick=\"return confirm('Yakin mau hapus?')\">Hapus</a></td>";
    echo "</tr>";
}
?>
</table>

<br>

<h2>Daftar Transaksi</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Waktu Transaksi</th>
    <th>Keterangan</th>
    <th>Total</th>
    <th>Pelanggan</th>
</tr>
<?php
// Transaksi
$q1 = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan_nama
       FROM transaksi t
       LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
       ORDER BY t.id";
$res1 = mysqli_query($koneksi, $q1);
while ($t = mysqli_fetch_assoc($res1)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($t['id']) . "</td>";
    echo "<td>" . htmlspecialchars($t['waktu_transaksi']) . "</td>";
    echo "<td>" . htmlspecialchars($t['keterangan']) . "</td>";
    echo "<td>" . htmlspecialchars($t['total']) . "</td>";
    echo "<td>" . htmlspecialchars($t['pelanggan_nama']) . "</td>";
    echo "</tr>";
}
?>
</table>

<br>

<h2>Daftar Transaksi Detail</h2>
<table border="1" cellpadding="5">
<tr>
    <th>Transaksi ID</th>
    <th>Barang ID</th>
    <th>Nama Barang</th>
    <th>Qty</th>
    <th>Harga (subtotal)</th>
</tr>
<?php
$q2 = "SELECT td.transaksi_id, td.barang_id, td.qty, td.harga, b.nama_barang
       FROM transaksi_detail td
       LEFT JOIN barang b ON td.barang_id = b.id
       ORDER BY td.transaksi_id, td.barang_id";
$res2 = mysqli_query($koneksi, $q2);
while ($d = mysqli_fetch_assoc($res2)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($d['transaksi_id']) . "</td>";
    echo "<td>" . htmlspecialchars($d['barang_id']) . "</td>";
    echo "<td>" . htmlspecialchars($d['nama_barang']) . "</td>";
    echo "<td>" . htmlspecialchars($d['qty']) . "</td>";
    echo "<td>" . htmlspecialchars($d['harga']) . "</td>";
    echo "</tr>";
}
?>
</table>

<br>
<a href="tambah_transaksi.php">Tambah Transaksi</a> |
<a href="tambah_detail.php">Tambah Transaksi Detail</a>

</body>
</html>
