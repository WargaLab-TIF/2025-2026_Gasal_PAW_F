<?php
$conn = new mysqli("localhost","root","","store");
if ($conn->connect_error) die("Koneksi gagal");

$from = $_GET['from'];
$to   = $_GET['to'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$q = $conn->query("
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$from' AND '$to'
    GROUP BY DATE(waktu_transaksi)
    ORDER BY DATE(waktu_transaksi)
");

$sum = $conn->query("
    SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$from' AND '$to'
")->fetch_assoc();

echo "<h3>Laporan Penjualan ($from s/d $to)</h3>";

echo "<table border='1' cellpadding='5' cellspacing='0'>
        <tr><th>No</th><th>Tanggal</th><th>Total</th></tr>";

$no = 1;
while ($r = $q->fetch_assoc()) {
    echo "<tr>
            <td>$no</td>
            <td>{$r['tgl']}</td>
            <td>{$r['total']}</td>
          </tr>";
    $no++;
}
echo "</table><br><br>";

echo "<table border='1' cellpadding='5'>
        <tr><th>Jumlah Pelanggan</th><td>{$sum['pelanggan']}</td></tr>
        <tr><th>Total Pendapatan</th><td>{$sum['pendapatan']}</td></tr>
      </table>";
?>
