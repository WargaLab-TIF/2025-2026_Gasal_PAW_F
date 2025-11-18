<?php
include "conn.php";

$mulai  = $_GET["mulai"];
$sampai = $_GET["sampai"];

$sql = "SELECT tanggal, 
               SUM(total) AS total_harian,
               COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan
        FROM transaksi
        WHERE tanggal BETWEEN '$mulai' AND '$sampai'
        GROUP BY tanggal
        ORDER BY tanggal ASC";

$hasil = mysqli_query($conn, $sql);

$total_pelanggan = 0;
$total_pendapatan = 0;
$rekap = [];

while ($r = mysqli_fetch_assoc($hasil)) {
    $rekap[] = $r;
    $total_pelanggan  += $r["jumlah_pelanggan"];
    $total_pendapatan += $r["total_harian"];
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table>
    <tr>
        <td><b>Rekap Laporan Penjualan <?= $mulai ?> sampai <?= $sampai ?></b></td>
    </tr>
</table>

<br>

<table border="1" cellspacing="0" cellpadding="5">
    <tr style="background:#d9e7ff;">
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

<?php
$no = 1;
foreach ($rekap as $r) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td>Rp<?= number_format($r["total_harian"],0,',','.') ?></td>
        <td><?= date("d-M-Y", strtotime($r["tanggal"])) ?></td>
    </tr>
<?php } ?>
</table>

<br>

<table border="1" cellspacing="0" cellpadding="5">
    <tr style="background:#d9e7ff;">
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total_pelanggan ?> Orang</td>
        <td>Rp<?= number_format($total_pendapatan,0,',','.') ?></td>
    </tr>
</table>

</body>
</html>