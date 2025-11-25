<?php
require 'koneksi.php';

$start = $_GET['start'] ?? date("Y-m-01");
$end   = $_GET['end'] ?? date("Y-m-d");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$q = mysqli_query($koneksi,"
    SELECT  
        waktu_transaksi AS tanggal,
        SUM(total) AS total_penerimaan,
        COUNT(pelanggan_id) AS total_pelanggan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$start' AND '$end'
    GROUP BY waktu_transaksi
    ORDER BY waktu_transaksi ASC
");

$totalPendapatan = 0;
$totalPelanggan = 0;

echo "<h3>Laporan Penjualan $start s/d $end</h3>";
echo "<table border='1'>
<tr style='background:#cce5ff; font-weight:bold;'>
<th>No</th>
<th>Tanggal</th>
<th>Total</th>
</tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($q)) {
    echo "<tr>
            <td>".$no++."</td>
            <td>".$row['tanggal']."</td>
            <td>Rp".number_format($row['total_penerimaan'])."</td>
          </tr>";

    $totalPendapatan += $row['total_penerimaan'];
    $totalPelanggan += $row['total_pelanggan'];
}

echo "</table><br>";

echo "<table border='1'>
<tr style='background:#cce5ff; font-weight:bold;'>
<th>Total Pelanggan</th>
<th>Total Pendapatan</th>
</tr>
<tr>
<td>$totalPelanggan Orang</td>
<td>Rp".number_format($totalPendapatan)."</td>
</tr>
</table>";
?>
