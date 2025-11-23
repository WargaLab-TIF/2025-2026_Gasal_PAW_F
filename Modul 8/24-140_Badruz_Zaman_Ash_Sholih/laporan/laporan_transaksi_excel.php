<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$tgl_awal  = $_GET['tgl_awal'] ?? '';
$tgl_akhir = $_GET['tgl_akhir'] ?? '';

$where = "";
if ($tgl_awal != "" && $tgl_akhir != "") {
    $where = "WHERE transaksi.waktu_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
}

$rekap = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    $where
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tgl ASC
");

$summary = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT 
        COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
        SUM(total) AS total_pendapatan
    FROM transaksi
    $where
"));

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
?>

<table border="1">
    <tr>
        <th colspan="3" style="background:#ddd; height:30px;">
            Rekap laporan penjualan <?= $tgl_awal ?> sampai <?= $tgl_akhir ?>
        </th>
    </tr>
</table>

<br>

<table border="1">
    <tr style="background:#eaeaea;">
        <th>No</th>
        <th>Tanggal</th>
        <th>Total (Rp)</th>
    </tr>

    <?php
    $no = 1;
    while ($r = mysqli_fetch_assoc($rekap)):
    ?>
        <tr style="text-align:center;">
            <td><?= $no++; ?></td>
            <td><?= $r['tgl'] ?></td>
            <td><?= number_format($r['total']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>

<br>

<table border="1">
    <tr style="background:#eaeaea;">
        <th>Jumlah Pelanggan</th>
        <th>Total Pendapatan</th>
    </tr>
    <tr style="text-align:center;">
        <td><?= $summary['jumlah_pelanggan'] ?></td>
        <td><?= number_format($summary['total_pendapatan']) ?></td>
    </tr>
</table>