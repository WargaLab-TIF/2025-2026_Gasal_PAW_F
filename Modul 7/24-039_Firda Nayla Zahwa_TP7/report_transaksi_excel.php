<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$conn = mysqli_connect("localhost", "root", "", "penjualan");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$start = $_GET['start'];
$end   = $_GET['end'];

$data = [];
$total_pendapatan = 0;
$jumlah_pelanggan = 0;

$q = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total_harian, COUNT(*) AS banyak_pelanggan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$start' AND '$end'
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tanggal
");

while ($row = mysqli_fetch_assoc($q)) {
    $data[] = $row;
    $total_pendapatan += $row['total_harian'];
    $jumlah_pelanggan += $row['banyak_pelanggan'];
}
?>

<h3>Rekap Laporan Penjualan <?= $start ?> sampai <?= $end ?></h3>

<table border="1" cellpadding="8">
    <tr style="background:#d9e6ff;">
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php $no = 1; foreach ($data as $d): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td>Rp<?= number_format($d['total_harian'], 0, ',', '.') ?></td>
        <td><?= date("d M Y", strtotime($d['tanggal'])) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<table border="1" cellpadding="8">
    <tr style="background:#d9e6ff;">
        <th colspan="2">Total</th>
    </tr>
    <tr>
        <td>Jumlah Pelanggan</td>
        <td><?= $jumlah_pelanggan ?> Orang</td>
    </tr>
    <tr>
        <td>Jumlah Pendapatan</td>
        <td>Rp<?= number_format($total_pendapatan, 0, ',', '.') ?></td>
    </tr>
</table>
