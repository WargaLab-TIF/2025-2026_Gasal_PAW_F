<?php
include "koneksi.php";

$mulai   = $_GET['mulai'];
$selesai = $_GET['selesai'];

// DATA REKAP
$rekapData = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

// TOTALAN
$totalan = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
"));
?>
<!DOCTYPE html>
<html>
<head>
<title>laporan_penjualan</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    font-family: Arial;
}

.header {
    background: #0086ff;
    color: white;
    padding: 10px;
    font-weight: bold;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

th, td {
    border: 1px solid #ccc;
    padding: 8px;
}

th {
    background: #a8d4ff;
}
</style>

</head>
<body onload="window.print()">

<div class="header">
    Rekap Laporan Penjualan <?= $mulai ?> s/d <?= $selesai ?>
</div>

<canvas id="grafik" height="120"></canvas>

<script>
let label = [];
let nilai = [];

<?php 
mysqli_data_seek($rekapData,0);
while($row = mysqli_fetch_assoc($rekapData)) { ?>
    label.push("<?= date('d M', strtotime($row['tgl'])) ?>");
    nilai.push(<?= $row['total'] ?>);
<?php } ?>

new Chart(document.getElementById("grafik"), {
    type: "bar",
    data: {
        labels: label,
        datasets: [{
            label: "Total Penjualan",
            data: nilai,
            backgroundColor: "rgba(213, 217, 221, 0.7)"
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
$no = 1;
mysqli_data_seek($rekapData,0);
while($row = mysqli_fetch_assoc($rekapData)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td>Rp<?= number_format($row['total'],0,",",".") ?></td>
    <td><?= date("d M Y", strtotime($row['tgl'])) ?></td>
</tr>
<?php } ?>
</table>

<table style="width:350px">
<tr>
    <th>Jumlah Pelanggan</th>
    <th>Total Pendapatan</th>
</tr>
<tr>
    <td><?= $totalan['pelanggan'] ?> Orang</td>
    <td>Rp<?= number_format($totalan['pendapatan'],0,",",".") ?></td>
</tr>
</table>

</body>
</html>
