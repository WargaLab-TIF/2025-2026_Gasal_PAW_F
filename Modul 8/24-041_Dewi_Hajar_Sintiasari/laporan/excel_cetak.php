<?php
include '../koneksi.php';

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$start_date = $_GET['start_date'] ?? '';
$end_date   = $_GET['end_date']   ?? '';

echo "<table border='1'>";
echo "<tr><th colspan='3'>Rekap Laporan Penjualan $start_date sampai $end_date</th></tr>";
echo "<tr></tr>";

echo "
<tr>
    <th>No</th>
    <th>Total</th>
    <th>Tanggal</th>
</tr>
";

$sql = "
    SELECT waktu_transaksi AS tanggal, total 
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$start_date' AND '$end_date'
    ORDER BY waktu_transaksi
";
$result = mysqli_query($koneksi, $sql);

$total_pendapatan = 0;
$jumlah_pelanggan = 0;
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $tgl = date("d-m-Y", strtotime($row['tanggal']));

    echo "
    <tr>
        <td>{$no}</td>
        <td>Rp" . number_format($row['total'], 2, ',', '.') . "</td>
        <td>{$tgl}</td>
    </tr>
    ";

    $no++;
    $jumlah_pelanggan++;
    $total_pendapatan += $row['total'];
}

echo "<tr></tr>";
echo "
<tr>
    <th>Jumlah Pelanggan</th>
    <th colspan='2'>Jumlah Pendapatan</th>
</tr>
<tr>
    <td>{$jumlah_pelanggan} Orang</td>
    <td colspan='2'>Rp" . number_format($total_pendapatan, 2, ',', '.') . "</td>
</tr>
";

echo "</table>";
?>