<?php
require_once "conn.php";



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
    <style>
        /* Gaya dari kode Anda */
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #343a40;
            padding: 20px 20px;
            color: white;
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-nav li {
            margin-left: 20px;
        }

        .navbar-nav a {
            color: #f8f9fa;
            text-decoration: none;
            font-size: 14px;
        }
        .navbar-nav a:hover {
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 6px;
        }
        .container h2 {
            font-size: 20px;
            font-weight: bold;
            background: #0275d8;
            padding: 20px 20px;
            color: white;
            border-radius: 6px;
            margin-top: 0;
            margin-bottom:20px;
        }
        .btn-kembali {
            display: inline-block;
            background: #0275d8;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .btn-kembali:hover {
            background: #025aa5;
        }
        .form-filter {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .form-filter input[type="date"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-tampilkan {
            background: #5cb85c;
            color: white;
            padding: 9px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-tampilkan:hover {
            background: #4a934a;
        }
        .chart-container {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white; 
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        th {
            background: #e9ecef;
            color: #212529;
            text-align: left;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e3e3e3;
            font-size: 14px;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .table-summary {
            width: auto;
            min-width: 400px;
        }
        .table-summary {
            width: auto;
            min-width: 400px;
        }
        .report-actions {
            margin-bottom: 20px;
        }
        .btn-print,
        .btn-excel {
            display: inline-block;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
            margin-left: 5px;
        }
        .btn-print {
            background: #ffc107;
            color: #212529;
        }
        .btn-excel {
            background: #28a745;
        }
    </style>
</head>
<body>
    <div class="top-navbar">
        <div class="navbar-brand">
            Penjualan / ELGHI </div>
        <ul class="navbar-nav">
            <li><a href="#">Supplier</a></li>
            <li><a href="#">Barang</a></li>
            <li><a href="#">Transaksi</a></li>
        </ul>
    </div>

    <div class="container">
        <?php if ($show_results): ?>
            <h2>Rekap Laporan Penjualan <?php echo $start_date; ?> sampai <?php echo $end_date; ?></h2>
            <a href="report_transaksi.php" class="btn-kembali">&lt; Kembali</a>
            <div class="report-actions no-print">
                <button onclick="window.print()" class="btn-print">Cetak</button>

                <a href="export_excel.php?start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&tampilkan=<?php echo $_GET['tampilkan']  ?>" class="btn-excel">Excel</a>
            </div>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>

            <h3>Rekap</h3>
            <table border="0" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
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
                        <td><?php echo $no++; ?></td>
                        <td><?php echo "Rp" . number_format($rekap['total_harian'], 0, ',', '.'); ?></td>
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
            <table class="table-summary" border="0" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>Jumlah Pelanggan</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $total_pelanggan; ?> Orang</td>
                        <td><?php echo "Rp" . number_format($total_pendapatan, 0, ',', '.'); ?></td>
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
                            label: 'Total',
                            data: data,
                            backgroundColor: 'rgba(200, 200, 200, 0.8)', 
                            borderColor: 'rgba(150, 150, 150, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        },
                    }
                });
            </script>
        <?php else: ?>
            <h2>Rekap Laporan Penjualan</h2>
            <a href="index.php" class="btn-kembali">&lt; Kembali</a>
            <form class="form-filter" action="report_transaksi.php" method="GET">
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