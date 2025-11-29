<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    exit;
}

// ambil tanggal
$mulai   = $_GET['mulai']   ?? null;
$selesai = $_GET['selesai'] ?? null;

// HEADER EXCEL
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

// DATA REKAP TOTAL HARIAN
$rekap = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

// DATA RATA-RATA PER HARI
$rataTanggal = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, AVG(total) AS rata
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

// TOTALAN
$totalan = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT COUNT(*) AS jumlah_transaksi,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
"));
?>

<table border="1">
    <tr>
        <th colspan="3" style="font-weight:bold; font-size:14px;">
            Rekap Laporan Penjualan <?= $mulai ?> sampai <?= $selesai ?>
        </th>
    </tr>

    <tr><td colspan="3"></td></tr>

    <!-- TABEL REKAP HARIAN -->
    <tr style="font-weight:bold; background:#d9d9d9;">
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php 
    $no = 1;
    mysqli_data_seek($rekap, 0);
    while ($r = mysqli_fetch_assoc($rekap)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>Rp<?= number_format($r['total'],0,",",".") ?></td>
            <td><?= date("d M Y", strtotime($r['tgl'])) ?></td>
        </tr>
    <?php } ?>

    <tr><td colspan="3"></td></tr>

    <!-- TABEL RATA-RATA -->
    <tr style="font-weight:bold; background:#d9d9d9;">
        <th>No</th>
        <th colspan="2">Rata-Rata Pendapatan</th>
    </tr>

    <?php 
    $no2 = 1;
    while ($rt = mysqli_fetch_assoc($rataTanggal)) { ?>
        <tr>
            <td><?= $no2++ ?></td>
            <td colspan="2">Rp<?= number_format($rt['rata'],0,",",".") ?></td>
        </tr>
    <?php } ?>

    <tr><td colspan="3"></td></tr>

    <!-- TABEL TOTALAN -->
    <tr style="font-weight:bold; background:#d9d9d9;">
        <th>Jumlah Transaksi</th>
        <th colspan="2">Total Pendapatan</th>
    </tr>

    <tr>
        <td><?= $totalan['jumlah_transaksi'] ?></td>
        <td colspan="2">Rp<?= number_format($totalan['pendapatan'],0,",",".") ?></td>
    </tr>

</table>
