<?php
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) die("Koneksi gagal.");

$from = $_GET['from'];
$to   = $_GET['to'];

$rekap = $conn->query("
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$from' AND '$to'
    GROUP BY DATE(waktu_transaksi)
")->fetch_all(MYSQLI_ASSOC);

$summary = $conn->query("
    SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$from' AND '$to'
")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Laporan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }
        h2, h4 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        @media print {
            a { display: none !important; }
            button { display: none !important; }
        }
    </style>
</head>

<body>

<h2>Laporan Penjualan</h2>
<h4><?= $from ?> sampai <?= $to ?></h4>

<canvas id="grafik"></canvas>

<script>
    const ctx = document.getElementById('grafik');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach ($rekap as $r) echo "'" . $r['tgl'] . "',"; ?>
            ],
            datasets: [{
                label: 'Total Penjualan',
                data: [
                    <?php foreach ($rekap as $r) echo $r['total'] . ","; ?>
                ]
            }]
        }
    });
</script>

<h3>Tabel Rekap Penjualan</h3>
<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Total</th>
    </tr>
    <?php $no=1; foreach ($rekap as $r): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['tgl'] ?></td>
        <td>Rp<?= number_format($r['total'],0,',','.') ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Ringkasan</h3>
<table style="width: 50%;">
    <tr>
        <th>Jumlah Pelanggan</th>
        <td><?= $summary['pelanggan'] ?></td>
    </tr>
    <tr>
        <th>Total Pendapatan</th>
        <td>Rp<?= number_format($summary['pendapatan'],0,',','.') ?></td>
    </tr>
</table>

<script>
    // Otomatis buka dialog print setelah halaman selesai diload
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>
