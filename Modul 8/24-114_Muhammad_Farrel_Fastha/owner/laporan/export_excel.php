<?php
include "conn.php";

$start = $_GET['start'];
$end   = $_GET['end'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");





$q = mysqli_query($conn,
    "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
     FROM transaksi
     WHERE DATE(waktu_transaksi) BETWEEN '$start' AND '$end'
     GROUP BY DATE(waktu_transaksi)"
);

$no = 1;
$total_pendapatan = 0;

echo "
<h3>Laporan Penjualan ($start s/d $end)</h3>

<table border='1' cellspacing='0' cellpadding='5'>
    <tr style='background:#d9eaff; font-weight:bold;'>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>
";

while ($row = mysqli_fetch_assoc($q)) {
    echo "
    <tr>
        <td>$no</td>
        <td>Rp " . number_format($row['total_harian'], 0, ',', '.') . "</td>
        <td>{$row['tgl']}</td>
    </tr>
    ";
    $total_pendapatan += $row['total_harian'];
    $no++;
}

echo "</table><br><br>";



$q2 = mysqli_query($conn,
    "SELECT COUNT(DISTINCT pelanggan_id) AS total_pelanggan
     FROM transaksi
     WHERE DATE(waktu_transaksi) BETWEEN '$start' AND '$end'"
);

$row2 = mysqli_fetch_assoc($q2);
$total_pelanggan = $row2['total_pelanggan'];

echo "
<table border='1' cellspacing='0' cellpadding='5'>
    <tr style='background:#d9eaff; text-align:center; font-weight:bold;'>
        <th>Total Pelanggan</th>
        <th>Total Pendapatan</th>
    </tr>
    <tr>
        <td>{$total_pelanggan} Pelanggan</td>
        <td>Rp " . number_format($total_pendapatan, 0, ',', '.') . "</td>
    </tr>
</table>
";

?>
