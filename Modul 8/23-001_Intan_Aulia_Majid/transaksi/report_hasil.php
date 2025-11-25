<?php
include "../auth.php";
include 'koneksi.php';

$tgl_mulai = $_GET['tgl_mulai'];
$tgl_selesai = $_GET['tgl_selesai'];

$sql = "SELECT 
            DATE(waktu_transaksi) AS tanggal, 
            SUM(total) AS total_harian
        FROM 
            transaksi 
        WHERE 
            DATE(waktu_transaksi) BETWEEN '$tgl_mulai' AND '$tgl_selesai'
        GROUP BY 
            DATE(waktu_transaksi)
        ORDER BY 
            tanggal ASC";

$result = mysqli_query($conn, $sql);


$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$chart_labels = [];
$chart_data = [];
$total_pendapatan = 0;
$total_pelanggan = 0; 

foreach ($data as $row) {
    $date_obj = date_create($row['tanggal']);
    $chart_labels[] = date_format($date_obj, 'd M Y');
    
    $chart_data[] = $row['total_harian'];
    $total_pendapatan += $row['total_harian'];
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card-header { background-color: #0d6efd; color: white; }
                
        @media print {
            .container {
                width: 100% !important;
                max-width: 100% !important;
            }

            .no-print {
                display: none !important;
            }

            canvas {
                max-width: 600px !important;
                max-height: 300px !important;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
            }
        }

    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Rekap Laporan Penjualan <?php echo htmlspecialchars($tgl_mulai); ?> sampai <?php echo htmlspecialchars($tgl_selesai); ?></h5>
            </div>
            <div class="card-body">
                
                <div class="mb-3 no-print">
                    <a href="report_transaksi.php" class="btn btn-secondary">&lt; Kembali</a>
                    
                    <button onclick="window.print()" class="btn btn-warning">Cetak</button>
                    
                    <a href="proses_excel.php?tgl_mulai=<?php echo $tgl_mulai; ?>&tgl_selesai=<?php echo $tgl_selesai; ?>" class="btn btn-success">Excel</a>
                </div>
                
                <div class="mb-5">
                    <canvas id="myChart"></canvas>
                </div>

                <h5 class="mt-4">Rekap Pendapatan per Tanggal</h5>
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($data as $row): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <?php 
                                    $date_obj = date_create($row['tanggal']);
                                    echo date_format($date_obj, 'd M Y'); 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo "Rp" . number_format($row['total_harian'], 0, ',', '.'); 
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h5 class="mt-4">Total Keseluruhan</h5>
                <table class="table table-bordered" style="max-width: 500px;">
                    <thead class="table-light">
                        <tr>
                            <th>Jumlah Pelanggan</th> <th>Jumlah Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>(Data Pelanggan)</td>
                            <td>
                                <?php 
                                    echo "Rp" . number_format($total_pendapatan, 0, ',', '.'); 
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: 'Total Pendapatan Harian',
                data: <?php echo json_encode($chart_data); ?>,
                borderWidth: 1,
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>