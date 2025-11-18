<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$start = $_GET['start'];
$end   = $_GET['end'];

$data = [];
$total_pendapatan = 0;
$jumlah_pelanggan = 0;

$q = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total_harian, COUNT(*) AS banyak_pelanggan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$start' AND '$end'
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tanggal
");

while ($row = mysqli_fetch_assoc($q)) {
    $data[] = $row;
    $total_pendapatan += $row['total_harian'];
    $jumlah_pelanggan += $row['banyak_pelanggan'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Print Laporan Penjualan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body { font-family: Arial; padding: 20px; }
    h2 { margin-bottom: 10px; }

    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th {
        background: #d9e6ff;
        padding: 10px;
        border: 1px solid #bcd0ff;
    }
    td {
        padding: 10px;
        border: 1px solid #bcd0ff;
    }

    .total-table th { text-align: center; }
</style>
</head>

<body>

<h2>Rekap Laporan Penjualan <?= $start ?> sampai <?= $end ?></h2>

<canvas id="chart" height="120"></canvas>

<script>
    const labels = <?= json_encode(array_column($data, 'tanggal')) ?>;
    const totals = <?= json_encode(array_column($data, 'total_harian')) ?>;

    new Chart(document.getElementById("chart"), {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Total",
                data: totals
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

    <?php $no = 1; foreach ($data as $d): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td>Rp<?= number_format($d['total_harian'], 0, ',', '.') ?></td>
        <td><?= date("d M Y", strtotime($d['tanggal'])) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<table class="total-table">
    <tr>
        <th colspan="2">Total</th>
    </tr>
    <tr>
        <td>Jumlah Pelanggan</td>
        <td><?= $jumlah_pelanggan ?> Orang</td>
    </tr>
    <tr>
        <td>Jumlah Pendapatan</td>
        <td>Rp<?= number_format($total_pendapatan, 0, ',', '.') ?></td>
    </tr>
</table>

<script>
    window.print();
</script>

</body>
</html>
