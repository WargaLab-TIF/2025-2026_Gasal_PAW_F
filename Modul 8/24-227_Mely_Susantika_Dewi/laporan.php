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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #f4f4f4;
}

/* NAVBAR */
.navbar {
    background: #2caa41ff; /* WARNA HIJAU */
    padding: 15px;
    color: white;
    font-size: 18px;
    font-weight: bold;
}

/* CONTENT CONTAINER */
.content {
    margin: 20px;
}

/* BOX KOTAK */
.box {
    background: white;
    padding: 15px;
    border: 1px solid #b6ddb8; 
    margin-bottom: 20px;
    border-radius: 5px;
}

/* INPUT + BUTTON */
input, button, a {
    padding: 6px 10px;
    border-radius: 4px;
    border: 1px solid #7cc68b;
    text-decoration: none;
}

/* BUTTON UTAMA */
button {
    cursor: pointer;
    background: #2caa41ff; /* hijau */
    color: white;
    border: none;
}

/* BUTTON EXCEL */
a.btn-green {
    background: #1e8b34; /* lebih gelap sedikit */
    color: white;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 5px;
    overflow: hidden;
}

/* HEADER TABEL */
th {
    background: #2caa41ff;
    color: white;
    padding: 10px;
    border: 1px solid #b6ddb8;
}

/* ISI TABEL */
td {
    border: 1px solid #cce7d1;
    padding: 8px;
    text-align: center;
}

/* PRINT MODE */
@media print {
    button, a, .no-print, .navbar {
        display: none;
    }
    body { padding: 0; }
}

</style>

</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    Sistem Laporan Penjualan
</div>

<!-- ISI KONTEN -->
<div class="content">

<h2>Lap Penjualan</h2>

<div class="box">
    <form method="GET" class="no-print">
        Dari: <input type="date" name="start" value="<?= $start ?>">
        Sampai: <input type="date" name="end" value="<?= $end ?>">
        <button>Tampilkan</button>
    </form>

    <br>

    <button onclick="window.print()" class="no-print">Print</button>
    <a href="laporan_excel.php?start=<?= $start ?>&end=<?= $end ?>" class="btn-green no-print">Excel</a>
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
    options: { scales: { y: { beginAtZero: true } } }
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
        while ($row = mysqli_fetch_assoc($q)) { ?>
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

</div> <!-- END CONTENT -->

</body>
</html>
