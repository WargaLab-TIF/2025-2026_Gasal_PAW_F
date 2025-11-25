<?php include 'koneksi.php'; ?>
<link rel="stylesheet" href="style.css">

<h2>Data Transaksi</h2>
<a href="report_transaksi.php" class="btn btn-primary">Lihat Laporan Penjualan</a>

<a href="transaksi_tambah.php">+ Tambah Transaksi</a> | <a href="index.php">Kembali</a>


<table border="1" cellpadding="5">
<tr><th>ID</th><th>Tanggal</th><th>Keterangan</th><th>Total</th><th>Pelanggan</th></tr>

<?php
$data = mysqli_query($koneksi, "SELECT t.*, p.nama as pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id=p.id");
while ($d = mysqli_fetch_array($data)) {
  echo "<tr>
          <td>$d[id]</td>
          <td>$d[waktu_transaksi]</td>
          <td>$d[keterangan]</td>
          <td>$d[total]</td>
          <td>$d[pelanggan]</td>
        </tr>";
}
?>
</table>
