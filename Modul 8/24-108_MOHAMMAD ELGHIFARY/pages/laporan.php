<?php
$start_date = null;
$end_date = null;
$data_rekap = [];
$total_pendapatan = 0;
$total_pelanggan = 0;
$show_results = false;

if (isset($_GET['tampilkan']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $show_results = true;
    
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $start_datetime = $start_date . ' 00:00:00';
    $end_datetime = $end_date . ' 23:59:59';

    $sql_rekap = "SELECT 
                    DATE_FORMAT(waktu_transaksi, '%d %b %Y') AS tanggal_formatted,
                    DATE(waktu_transaksi) AS tanggal, 
                        SUM(total) AS total_harian
                    FROM 
                        transaksi
                    WHERE 
                        waktu_transaksi BETWEEN ? AND ?
                    GROUP BY 
                        DATE(waktu_transaksi)
                    ORDER BY 
                        tanggal ASC";
    
    $stmt_rekap = mysqli_prepare($conn, $sql_rekap);
    mysqli_stmt_bind_param($stmt_rekap, 'ss', $start_datetime, $end_datetime);
    mysqli_stmt_execute($stmt_rekap);
    $result_rekap = mysqli_stmt_get_result($stmt_rekap);
    while ($row = mysqli_fetch_assoc($result_rekap)) {
        $data_rekap[] = $row;
    }

    $sql_total = "SELECT
                        COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
                        SUM(total) AS jumlah_pendapatan
                    FROM
                        transaksi
                    WHERE
                        waktu_transaksi BETWEEN ? AND ?";

    $stmt_total = mysqli_prepare($conn, $sql_total);
    mysqli_stmt_bind_param($stmt_total, 'ss', $start_datetime, $end_datetime);
    mysqli_stmt_execute($stmt_total);
    $result_total = mysqli_stmt_get_result($stmt_total);
    $row_total = mysqli_fetch_assoc($result_total);
    
    $total_pelanggan = $row_total['jumlah_pelanggan'] ?? 0;
    $total_pendapatan = $row_total['jumlah_pendapatan'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./css/laporan.css">
</head>
<body>
    <div class="container">
        <?php if ($show_results): ?>
            <h2>Rekap Laporan Penjualan <?php echo $start_date; ?> sampai <?php echo $end_date; ?></h2>
            <a href="index.php?page=laporan" class="btn-kembali">&lt; Kembali</a>
            <div class="report-actions no-print">
                <button onclick="window.print()" class="btn-print">Cetak</button>
                <a href="export_excel.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&tampilkan=1" class="btn-excel">Excel</a>
            </div>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>

            <h3>Rekap</h3>
            <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f4f4f4;">
                        <th>No</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data_rekap as $rekap): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no++; ?></td>
                        <td><?php echo "Rp " . number_format($rekap['total_harian'], 0, ',', '.'); ?></td>
                        <td><?php echo $rekap['tanggal_formatted']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data_rekap)): ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Tidak ada data pada rentang tanggal ini.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h3>Total</h3>
            <table class="table-summary" border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f4f4f4;">
                        <th>Jumlah Pelanggan</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;"><?php echo $total_pelanggan; ?> Orang</td>
                        <td style="text-align:center; font-weight:bold;"><?php echo "Rp " . number_format($total_pendapatan, 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>

            <script>
                const rekapData = <?php echo json_encode($data_rekap); ?>;
                const labels = rekapData.map(item => item.tanggal);
                const data = rekapData.map(item => item.total_harian);
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: data,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)', 
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        <?php else: ?>
            <h2>Rekap Laporan Penjualan</h2>
            <form class="form-filter" action="index.php" method="GET">
                <input type="hidden" name="page" value="laporan">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" id="start_date" name="start_date" required>
                <label for="end_date">Tanggal Selesai:</label>
                <input type="date" id="end_date" name="end_date" required>
                <button type="submit" name="tampilkan" value="1" class="btn-tampilkan">Tampilkan</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>