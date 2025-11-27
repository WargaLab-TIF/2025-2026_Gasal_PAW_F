<?php
include 'koneksi.php';

if (!isset($conn) || $conn === false) {
    die("Koneksi database gagal.");
}

$awal  = isset($_GET['tgl_awal']) ? mysqli_real_escape_string($conn, $_GET['tgl_awal']) : date('Y-m-01');
$akhir = isset($_GET['tgl_akhir']) ? mysqli_real_escape_string($conn, $_GET['tgl_akhir']) : date('Y-m-d');

$sqlRekap = "SELECT 
                DATE(transaksi.waktu_transaksi) AS tgl,
                SUM(transaksi_detail.harga * transaksi_detail.qty) AS total
            FROM transaksi
            JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
            WHERE DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'
            GROUP BY DATE(transaksi.waktu_transaksi)
            ORDER BY DATE(transaksi.waktu_transaksi) ASC";
$resultRekap = mysqli_query($conn, $sqlRekap);

if (!$resultRekap) {
    die("Query Rekap Gagal: " . mysqli_error($conn));
}

$sqlSummary = "SELECT 
                    COUNT(DISTINCT transaksi.id) AS total_pelanggan,
                    SUM(transaksi_detail.harga * transaksi_detail.qty) AS total_pendapatan_semua
                FROM transaksi
                JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
                WHERE DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'";
$rSummary = mysqli_query($conn, $sqlSummary);
$dSummary = mysqli_fetch_assoc($rSummary);

$totalPelanggan = $dSummary['total_pelanggan'];
$totalPendapatanSemua = $dSummary['total_pendapatan_semua'];

header("Content-type: application/vnd.ms-excel");
$filename = "laporan_penjualan" . date('Ymd', strtotime($awal)) . "_sd_" . date('Ymd', strtotime($akhir)) . ".xls";
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

?>
<html>
<head>
    <title>Rekap Laporan Penjualan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<h3>Rekap Laporan Penjualan <?= date('d M Y', strtotime($awal)) ?> sampai <?= date('d M Y', strtotime($akhir)) ?></h3>

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
        if (mysqli_num_rows($resultRekap) > 0) {
            while ($row = mysqli_fetch_assoc($resultRekap)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>Rp<?= $row['total'] ?></td> 
            <td><?= date('d-M-y', strtotime($row['tgl'])) ?></td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<br> 
<br> 

<table border="0"> <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $totalPelanggan ?> Orang</td>
        <td>Rp<?= $totalPendapatanSemua ?></td>
    </tr>
</table>

</body>
</html>

<?php
exit;
?>