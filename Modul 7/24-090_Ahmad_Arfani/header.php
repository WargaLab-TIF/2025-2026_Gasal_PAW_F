<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
include 'koneksi.php';
if (isset($_GET['tgl_mulai'])) {
    $tgl_mulai = $_GET['tgl_mulai'];
} else {
    $tgl_mulai = date('Y-m-d');
}
if (isset($_GET['tgl_selesai'])) {
    $tgl_selesai = $_GET['tgl_selesai'];
} else {
    $tgl_selesai = date('Y-m-d');
}
$data_laporan = array();
$total_pelanggan = 0;
$total_pendapatan = 0;
$sql_harian = "SELECT DATE(waktu_transaksi) as tanggal, SUM(total) as total_harian FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai' GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC";
$query_harian = mysqli_query($koneksi, $sql_harian);
while ($row = mysqli_fetch_assoc($query_harian)):
    $data_laporan[] = $row;
endwhile;
$sql_total = "SELECT COUNT(DISTINCT nama_pelanggan) as total_pelanggan, SUM(total) as total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
$query_total = mysqli_query($koneksi, $sql_total);
$hasil_total = mysqli_fetch_assoc($query_total);
$total_pelanggan = $hasil_total['total_pelanggan'];
$total_pendapatan = $hasil_total['total_pendapatan'];
?>

<b>Rekap Laporan Penjualan <?= $tgl_mulai; ?> sampai <?= $tgl_selesai; ?></b>
<br>
<br>
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        foreach ($data_laporan as $data): 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>Rp<?= number_format($data['total_harian'], 0, ',', '.'); ?></td>
            <td><?= date('d-M-y', strtotime($data['tanggal'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<table border="1">
    <thead>
        <tr>
            <th>Jumlah Pelanggan</th>
            <th>Jumlah Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $total_pelanggan; ?> Orang</td>
            <td>Rp<?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
        </tr>
    </tbody>
</table>