<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$tgl_mulai = $_GET['tgl_mulai'];
$tgl_selesai = $_GET['tgl_selesai'];

$data_laporan = array();
$sql_harian = "SELECT DATE(waktu_transaksi) as tanggal, SUM(total) as total_harian FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai' GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC";
$query_harian = mysqli_query($koneksi, $sql_harian);
while ($row = mysqli_fetch_assoc($query_harian)) {
    $data_laporan[] = $row;
}
?>

<b>Rekap Laporan Penjualan <?= $tgl_mulai; ?> sampai <?= $tgl_selesai; ?></b>
<table border="1">
    <thead>
        <tr><th>No</th><th>Tanggal</th><th>Total</th></tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($data_laporan as $data): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['tanggal']; ?></td>
            <td><?= $data['total_harian']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>