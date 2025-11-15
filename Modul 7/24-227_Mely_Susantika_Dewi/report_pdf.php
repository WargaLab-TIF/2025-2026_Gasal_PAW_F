<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");

$start = $_GET['start'];
$end   = $_GET['end'];

$q = mysqli_query($koneksi,"
    SELECT waktu_transaksi AS tanggal, SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$start' AND '$end'
    GROUP BY waktu_transaksi
");

echo "<h2>Laporan Penjualan ($start s/d $end)</h2>";

echo "<table border='1' cellpadding='5'>
<tr>
    <th>Tanggal</th>
    <th>Total</th>
</tr>";

$totalAll = 0;

while ($r = mysqli_fetch_assoc($q)) {
    echo "<tr>
            <td>{$r['tanggal']}</td>
            <td>{$r['total']}</td>
          </tr>";
    $totalAll += $r['total'];
}

echo "</table>";

echo "<h3>Total: Rp " . number_format($totalAll) . "</h3>";
