<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$start = isset($_GET['start']) ? $_GET['start'] : "";
$end   = isset($_GET['end']) ? $_GET['end'] : "";

$data = [];
$total_pendapatan = 0;
$jumlah_pelanggan = 0;

if ($start != "" && $end != "") {
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
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background: #fafafa;
    }

    .filter-box {
        background: #eee;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    input[type="date"] {
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-right: 10px;
    }

    button {
        padding: 7px 12px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        color: white;
        background: #28a745;
    }
    button:hover { background: #1e7e34; }

  
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    th {
        background: #d9e6ff;
        padding: 10px;
        border: 1px solid #bcd0ff;
        text-align: left;
    }

    td {
        padding: 10px;
        border: 1px solid #bcd0ff;
        background: white;
    }

  
    .total-table th {
        background: #d9e6ff;
        text-align: center;
    }

  
    .btn-area {
        margin-top: 20px;
    }

    .btn-area a {
        padding: 7px 15px;
        margin-right: 10px;
        text-decoration: none;
        border-radius: 3px;
        color: white;
    }

    .back { background: #777; }
    .print { background: #007bff; }
    .excel { background: #ff9800; }

</style>
</head>

<body>

<h2>Laporan Penjualan</h2>

<div class="filter-box">
    <form method="get">
        <input type="date" name="start" value="<?= $start ?>" required>
        <input type="date" name="end" value="<?= $end ?>" required>
        <button type="submit">Tampilkan</button>
    </form>
</div>

<?php if ($start != "" && $end != "") { ?>

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

<div class="btn-area">
    <a href="data_transaksi.php" class="back">Kembali</a>
    <a href="report_transaksi_print.php?start=<?= $start ?>&end=<?= $end ?>" class="print">Print</a>
    <a href="report_transaksi_excel.php?start=<?= $start ?>&end=<?= $end ?>" class="excel">Excel</a>
</div>

<?php } ?>

</body>
</html>
