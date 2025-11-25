<?php
include 'koneksi.php';

$data = [];
$totalPendapatan = 0;
$totalPelanggan = 0;

// Jika user menekan tombol Tampilkan
if (isset($_GET['dari']) && isset($_GET['sampai'])) {

    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];

    // Ambil data transaksi
    $data = mysqli_query($conn, "
        SELECT *
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
        ORDER BY waktu_transaksi ASC
    ");

    // Hitung total pendapatan
    $totalPendapatan = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT SUM(total) AS total
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
    "))['total'] ?? 0;

    // Hitung jumlah pelanggan
    $totalPelanggan = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT COUNT(*) AS total
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
    "))['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<h2>Laporan Penjualan</h2>

<a href="home.php">Kembali</a>
<br><br>

<!-- FORM FILTER -->
<form method="GET">
    Dari:
    <input type="date" name="dari" required value="<?= $_GET['dari'] ?? '' ?>">
    &nbsp;&nbsp;
    Sampai:
    <input type="date" name="sampai" required value="<?= $_GET['sampai'] ?? '' ?>">
    &nbsp;
    <button type="submit">Tampilkan</button>
</form>

<hr>

<?php if (!empty($_GET['dari'])) { ?>

<h3>Grafik Penjualan</h3>
<canvas id="myChart" width="400" height="200"></canvas>

<script>
// Siapkan data untuk grafik
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

var ctx = document.getElementById('myChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Penjualan',
            data: values
        }]
    }
});
</script>

<br>

<!-- TABEL DATA -->
<h3>Data Penjualan</h3>
<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Pelanggan</th>
    </tr>

    <?php
    mysqli_data_seek($data, 0);
    while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['waktu_transaksi'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td><?= $row['total'] ?></td>
            <td><?= $row['pelanggan_id'] ?></td>
        </tr>
    <?php } ?>
</table>

<br>

<!-- TOTAL -->
<h3>Ringkasan</h3>
<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <th>Total Pelanggan</th>
        <th>Total Pendapatan</th>
    </tr>
    <tr>
        <td><?= $totalPelanggan ?></td>
        <td><?= $totalPendapatan ?></td>
    </tr>
</table>

<br>

<!-- TOMBOL PRINT & EXCEL -->
<a href="cetak.php?dari=<?= $dari ?>&sampai=<?= $sampai ?>">Print</a> |
<a href="export_excel.php?dari=<?= $dari ?>&sampai=<?= $sampai ?>">Export Excel</a>

<?php } ?>

</body>
</html>
