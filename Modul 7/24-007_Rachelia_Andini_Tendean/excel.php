<?php
include "koneksi.php";

$mulai   = $_GET['mulai'];
$selesai = $_GET['selesai'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil data transaksi
$rekapData = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

// Total kesimpulan
$totalan = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
"));
?>

<table border="1">

    <tr>
        <th colspan="3" style="font-size:14px; font-weight:bold;">
            Rekap Laporan Penjualan <?= $mulai ?> sampai <?= $selesai ?>
        </th>
    </tr>

    <tr>
        <td colspan="3" style="border:none;"></td>
    </tr>

    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($rekapData)) {

        $tanggal = date("d-M-Y", strtotime($row['tgl']));
        $totalRp = "Rp" . number_format($row['total'], 0, ",", ".");

        echo "
        <tr>
            <td>$no</td>
            <td>$totalRp</td>
            <td>$tanggal</td>
        </tr>";

        $no++;
    }
    ?>

    <tr>
        <td colspan="3" style="border:none;"></td>
    </tr>

    <tr>
        <th>Jumlah Pelanggan</th>
        <th colspan="2">Jumlah Pendapatan</th>
    </tr>

    <tr>
        <td><?= $totalan['pelanggan'] ?> Orang</td>
        <td colspan="2">Rp<?= number_format($totalan['pendapatan'], 0, ",", ".") ?></td>
    </tr>

</table>
