<?php 
include 'koneksi.php'; 
?>
<link rel="stylesheet" href="style.css">

<h2>Data Detail Transaksi</h2>
<a href="transaksi_detail_tambah.php">+ Tambah Detail</a> | <a href="index.php">Kembali</a>

<table border="1" cellpadding="5">
<tr>
    <th>ID Transaksi</th>
    <th>Barang</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Subtotal</th>
</tr>

<?php
// Ambil data detail transaksi + nama barang
$data = mysqli_query($koneksi, "
    SELECT td.*, b.nama_barang AS barang, b.harga 
    FROM transaksi_detail td
    LEFT JOIN barang b ON td.barang_id = b.id
");

// Variabel untuk hitung total seluruh transaksi
$total_semua = 0;

while ($d = mysqli_fetch_array($data)) {
    // Hitung subtotal jika belum disimpan di database
    $subtotal = isset($d['subtotal']) ? $d['subtotal'] : ($d['qty'] * $d['harga']);
    $total_semua += $subtotal;

    echo "<tr>
            <td>{$d['transaksi_id']}</td>
            <td>{$d['barang']}</td>
            <td>{$d['qty']}</td>
            <td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>
            <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
          </tr>";
}
?>
</table>

<h3 style="text-align:right; margin-right:30px;">
    Total Semua Transaksi: Rp <?= number_format($total_semua, 0, ',', '.') ?>
</h3>
