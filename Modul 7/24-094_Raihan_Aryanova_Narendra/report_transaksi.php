<?php
include 'koneksi.php';

$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

$query = "SELECT date_transaksi, SUM(total) as total_harian 
          FROM transaksi 
          WHERE date_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'
          GROUP BY date_transaksi
          ORDER BY date_transaksi ASC";
$result = mysqli_query($koneksi, $query);

$chart_labels = [];
$chart_data = [];
$table_data = [];
$grand_total = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $formatted_date = date('d M Y', strtotime($row['date_transaksi']));
    $chart_labels[] = $formatted_date;
    $chart_data[] = $row['total_harian'];
    $table_data[] = ['tanggal' => $formatted_date, 'total' => $row['total_harian']];
    $grand_total += $row['total_harian'];
}

$query_pelanggan = "SELECT COUNT(DISTINCT id_pelanggan) as jumlah_pelanggan 
                    FROM transaksi 
                    WHERE date_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
$data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
$jumlah_pelanggan = $data_pelanggan['jumlah_pelanggan'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <div class="header-title">
        <h2>
            Rekap Laporan Penjualan <?php echo date('d M Y', strtotime($tgl_awal)); ?> sampai <?php echo date('d M Y', strtotime($tgl_akhir)); ?>
        </h2>
    </div>

    <div class="nav-buttons">
        <a href="index.php" class="button btn-back">&lt; Kembali</a>
        
        <div>
            <button onclick="window.print()" class="button btn-pdf">Cetak PDF</button>
            <a href="export_excel.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank" class="button btn-excel">Export Excel</a>
        </div>
    </div>

    <div class="filter-box">
        <form method="GET" action="" class="filter-box" style="border:none; padding:0; margin:0; background:transparent;">
            <div class="filter-item">
                <label>Tanggal Awal</label>
                <input type="date" name="tgl_awal" value="<?php echo $tgl_awal; ?>">
            </div>
            <div class="filter-item">
                <label>Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
            </div>
            <button type="submit" class="button">Filter</button>
        </form>
    </div>

    <div id="content-to-print">
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>

        <table border="1" class="report-table">
            <thead>
                <tr>
                    <th class="w-50">No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if (count($table_data) > 0) {
                    foreach ($table_data as $row) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['tanggal'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="summary-container">
            <div class="summary-box">
                <span class="summary-label">Jumlah Pelanggan</span>
                <span class="summary-value"><?php echo $jumlah_pelanggan; ?> Orang</span>
            </div>
            <div class="summary-box">
                <span class="summary-label">Jumlah Pendapatan</span>
                <span class="summary-value">Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></span>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: <?php echo json_encode($chart_data); ?>,
                backgroundColor: '#d1d5db',
                borderColor: '#9ca3af',
                borderWidth: 1,
                hoverBackgroundColor: '#4f46e5'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

</body>
</html>