<?php
include "koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Penjualan.xls");

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];

$sql = mysqli_query($conn,"
    SELECT tanggal, SUM(total) AS total
    FROM (
        SELECT 
            t.waktu_transaksi AS tanggal,
            COALESCE(td.harga * td.qty, t.total, 0) AS total
        FROM transaksi t
        LEFT JOIN transaksi_detail td ON td.transaksi_id = t.id
        WHERE t.waktu_transaksi BETWEEN '$tgl1' AND '$tgl2'
    ) x
    GROUP BY tanggal
    ORDER BY tanggal
");

$total_all = 0;
$count = 0;
?>

<h2>LAPORAN PENJUALAN (<?= $tgl1 ?> s/d <?= $tgl2 ?>)</h2>

<table border="1">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Total Penjualan</th>
    </tr>

<?php 
$no = 1;
while($row = mysqli_fetch_assoc($sql)){
    echo "<tr>
            <td>$no</td>
            <td>{$row['tanggal']}</td>
            <td>".number_format($row['total'])."</td>
        </tr>";

    $total_all += $row['total'];
    $count++;
    $no++;
}
?>

    <tr>
        <th colspan="2">Total Transaksi</th>
        <th><?= $count ?></th>
    </tr>

    <tr>
        <th colspan="2">Total Pendapatan</th>
        <th>Rp <?= number_format($total_all) ?></th>
    </tr>
</table>
