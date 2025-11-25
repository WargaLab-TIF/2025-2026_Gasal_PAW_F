<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"laporan_penjualan.xls\"");

include 'koneksi.php';

$tgl_mulai = $_GET['tgl_mulai'];
$tgl_selesai = $_GET['tgl_selesai'];

$sql = "SELECT 
            DATE(waktu_transaksi) AS tanggal, 
            SUM(total) AS total_harian
        FROM transaksi
        WHERE DATE(waktu_transaksi) BETWEEN '$tgl_mulai' AND '$tgl_selesai'
        GROUP BY DATE(waktu_transaksi)
        ORDER BY tanggal ASC";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$total_pendapatan = 0;
foreach ($data as $row) {
    $total_pendapatan += $row['total_harian'];
}


$sql_pelanggan = "SELECT COUNT(*) AS jumlah_pelanggan 
                  FROM transaksi 
                  WHERE DATE(waktu_transaksi) BETWEEN '$tgl_mulai' AND '$tgl_selesai'";

$result_pelanggan = mysqli_query($conn, $sql_pelanggan);
$row_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$jumlah_pelanggan = $row_pelanggan['jumlah_pelanggan'];

?>

<table border="1">
    <tr>
        <td colspan="3"><b>Rekap Laporan Penjualan <?= $tgl_mulai ?> sampai <?= $tgl_selesai ?></b></td>
    </tr>

    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php 
    $no = 1;
    foreach($data as $row): 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['total_harian']; ?></td>
        <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<table border="1">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th colspan="2">Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $jumlah_pelanggan; ?></td>
        <td colspan="2"><?= $total_pendapatan; ?></td>
    </tr>
</table>
