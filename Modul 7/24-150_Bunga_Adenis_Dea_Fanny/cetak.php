<?php
include 'koneksi.php';

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

$data = mysqli_query($conn, "
    SELECT *
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
    ORDER BY waktu_transaksi ASC
");


// Total Pendapatan
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
"))['total'] ?? 0;


// Total Pelanggan
$totalPelanggan = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
"))['total'] ?? 0;

// reset pointer data
mysqli_data_seek($data, 0);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body onload="window.print()">

<h2>Laporan Penjualan</h2>
<p>Periode: <?= $dari ?> s/d <?= $sampai ?></p>

<canvas id="chartPrint" width="600" height="250"></canvas>

<script>
var labels = [
<?php
mysqli_data_seek($data, 0);
while ($row = mysqli_fetch_assoc($data)) {
    echo "'" . $row['waktu_transaksi'] . "',";
}
?>
];

var values = [
<?php
mysqli_data_seek($data, 0);
while ($row = mysqli_fetch_assoc($data)) {
    echo $row['total'] . ",";
}
?>
];

var ctx = document.getElementById("chartPrint").getContext("2d");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: labels,
        datasets: [{
            label: "Total Penjualan",
            data: values
        }]
    }
});
</script>

<br><br>

<h3>Rekap Penjualan</h3>

<table border="1" cellspacing="0" cellpadding="6">
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Pelanggan</th>
    </tr>

<?php
$no = 1;
mysqli_data_seek($data, 0);
while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
        <td><?= $row['waktu_transaksi'] ?></td>
        <td><?= $row['keterangan'] ?></td>
        <td><?= $row['pelanggan_id'] ?></td>
    </tr>
<?php } ?>
</table>

<br><br>

<h3>Total</h3>

<table border="1" cellspacing="0" cellpadding="6">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $totalPelanggan ?> Orang</td>
        <td>Rp<?= number_format($totalPendapatan, 0, ',', '.') ?></td>
    </tr>
</table>

</body>
</html>
