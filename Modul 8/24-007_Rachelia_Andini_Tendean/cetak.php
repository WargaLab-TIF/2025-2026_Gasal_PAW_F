<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$mulai = $_GET['mulai'];
$selesai = $_GET['selesai'];

$rekap = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

$rataTanggal = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, AVG(total) AS rata
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

$totalan = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT COUNT(*) AS jumlah_transaksi,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
"));
?>
<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{font-family:Arial, Helvetica, sans-serif;}
.header{background:#0086ff;color:white;padding:12px 18px;font-weight:bold;margin-bottom:10px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{padding:8px;border:1px solid #cfd8dc;}
th{background:#a8d4ff;}
</style>
</head>

<body onload="window.print()">

<div class="header">
Laporan Penjualan <?= $mulai ?> s/d <?= $selesai ?>
</div>

<canvas id="grafik" height="120"></canvas>

<script>
let label = [];
let nilai = [];
<?php 
mysqli_data_seek($rekap,0);
while($r=mysqli_fetch_assoc($rekap)){ ?>
label.push("<?= date('d M', strtotime($r['tgl'])) ?>");
nilai.push(<?= $r['total'] ?>);
<?php } ?>

new Chart(document.getElementById('grafik'), {
    type: "bar",
    data: {
        labels: label,
        datasets: [{
            label: "Total Penjualan",
            data: nilai,
            backgroundColor: "rgba(213,217,221,0.7)"
        }]
    }
});
</script>

<table>
<tr>
<th>No</th>
<th>Total</th>
<th>Tanggal</th>
</tr>
<?php 
$no=1;
mysqli_data_seek($rekap,0);
while($r=mysqli_fetch_assoc($rekap)){ ?>
<tr>
<td style="text-align:center;"><?= $no++ ?></td>
<td>Rp<?= number_format($r['total'],0,",",".") ?></td>
<td><?= date("d M Y", strtotime($r['tgl'])) ?></td>
</tr>
<?php } ?>
</table>

<table style="width:460px;margin-top:15px;">
<tr>
<th style="text-align:center;">Tanggal</th>
<th style="text-align:center;">Rata-rata Pendapatan</th>
</tr>
<?php 
while($rt=mysqli_fetch_assoc($rataTanggal)){ ?>
<tr>
<td><?= date("d M Y", strtotime($rt['tgl'])) ?></td>
<td>Rp<?= number_format($rt['rata'],0,",",".") ?></td>
</tr>
<?php } ?>
</table>

<table style="width:460px;margin-top:15px;">
<tr>
<th>Jumlah Transaksi</th>
<th>Total Pendapatan</th>
</tr>
<tr>
<td><?= $totalan['jumlah_transaksi'] ?></td>
<td>Rp<?= number_format($totalan['pendapatan'],0,",",".") ?></td>
</tr>
</table>

</body>
</html>
