<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// tanggal filter
$start = $_GET['start'] ?? date("Y-m-01");
$end   = $_GET['end'] ?? date("Y-m-d");

// ambil laporan
$q = mysqli_query($koneksi,"
    SELECT 
        waktu_transaksi AS tanggal,
        SUM(total) AS total_penerimaan,
        COUNT(pelanggan_id) AS total_pelanggan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$start' AND '$end'
    GROUP BY waktu_transaksi
    ORDER BY waktu_transaksi ASC
");

$tanggal = [];
$penerimaan = [];
$totalPelanggan = 0;
$totalPendapatan = 0;

while ($row = mysqli_fetch_assoc($q)) {
    $tanggal[] = $row['tanggal'];
    $penerimaan[] = $row['total_penerimaan'];
    $totalPelanggan += $row['total_pelanggan'];
    $totalPendapatan += $row['total_penerimaan'];
}

if (empty($tanggal)) {
    $tanggal = ["Tidak Ada Data"];
    $penerimaan = [0];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>

<style>
    body {
        font-family: Arial;
        background: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h2 {
        margin-top: 0;
    }

    .box {
        background: white;
        padding: 15px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    input, button, a {
        padding: 6px 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        text-decoration: none;
    }

    button {
        cursor: pointer;
        background: #007bff;
        color: white;
        border: none;
    }

    button:hover {
        background: #005fcc;
    }

    a.btn-green {
        background: #28a745;
        color: white;
    }

    a.btn-green:hover {
        background: #1f7b34;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        background: white;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    th {
        background: #007bff;
        color: white;
    }

    @media print {
        button, a, .no-print {
            display: none;
        }
        body { padding: 0; }
    }
</style>

</head>
<body>

<h2>Lap Penjualan</h2>

<div class="box">
    <form method="GET" class="no-print">
        Dari: <input type="date" name="start" value="<?= $start ?>">
        Sampai: <input type="date" name="end" value="<?= $end ?>">
        <button>Tampilkan</button>
    </form>

    <br>

    <button onclick="window.print()" class="no-print">Print</button>
    <a href="report_excel.php?start=<?= $start ?>&end=<?= $end ?>" class="btn-green no-print">Excel</a>
</div>

<div class="box">
    <h3>Grafik Penerimaan</h3>
    <canvas id="chart"></canvas>
</div>

<script>
new Chart(document.getElementById("chart"), {
    type: "bar",
    data: {
        labels: <?= json_encode($tanggal) ?>,
        datasets: [{
            label: "Total Penerimaan",
            data: <?= json_encode($penerimaan) ?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<div class="box">
    <h3>Rekap Per Tanggal</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>

        <?php
        mysqli_data_seek($q, 0);
        $no = 1;
        while ($row = mysqli_fetch_assoc($q)) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td>Rp<?= number_format($row['total_penerimaan']) ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div class="box">
    <h3>Total Keseluruhan</h3>
    <table>
        <tr>
            <th>Total Pelanggan</th>
            <th>Total Pendapatan</th>
        </tr>

        <tr>
            <td><?= $totalPelanggan ?> Orang</td>
            <td>Rp<?= number_format($totalPendapatan) ?></td>
        </tr>
    </table>
</div>

</body>
</html>
