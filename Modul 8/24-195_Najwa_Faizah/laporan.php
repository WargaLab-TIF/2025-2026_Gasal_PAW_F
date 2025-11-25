<?php
include './layout/header.php';
$dataTabel = []; 
$totalPendapatan = 0; 
$totalPelanggan = 0; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    
    $sql = "SELECT transaksi.id_transaksi, transaksi.waktu_transaksi, pelanggan.nama_pelanggan, transaksi.keterangan, transaksi.total 
            FROM transaksi 
            JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
            WHERE transaksi.waktu_transaksi BETWEEN '$startDate' AND '$endDate'";
    
    $result = $conn->query($sql);

    if (!$result) {
        die("Query gagal: " . $conn->error); 
    }

    while ($row = $result->fetch_assoc()) {
        $dataTabel[] = $row;
        $totalPendapatan += $row["total"]; 
    }

    $totalPelanggan = count(array_unique(array_column($dataTabel, 'nama_pelanggan')));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h5 class="text-white bg-primary p-3">Rekap Laporan Penjualan <?php echo isset($startDate) ? $startDate : ""; ?> sampai <?php echo isset($endDate) ? $endDate : ""; ?></h5>

        <form method="POST" action="laporan.php">
            <div class="form-row no-print">
                <div class="col">
                    <label for="startDate">Tanggal Mulai</label>
                    <input type="date" id="startDate" name="startDate" class="form-control" required>
                </div>
                <div class="col">
                    <label for="endDate">Tanggal Selesai</label>
                    <input type="date" id="endDate" name="endDate" class="form-control" required>
                </div>
                <div class="col">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">Tampilkan Laporan</button>
                </div>
            </div>
        </form>

        <?php if (!empty($dataTabel)) { ?>
            <div class="no-print mt-3">
                <a href="index.php" class="btn btn-primary">Kembali</a>
                <button onclick="window.print()" class="btn btn-warning">Cetak</button>
                <form action="export_excel.php" method="POST" style="display: inline;">
                    <input type="hidden" name="startDate" value="<?php echo $startDate; ?>">
                    <input type="hidden" name="endDate" value="<?php echo $endDate; ?>">
                    <button type="submit" class="btn btn-warning">Excel</button>
                </form>
            </div>

            <div class="mt-5">
                <canvas id="transaksiChart"></canvas>
            </div>

            <div class="mt-5">
                <table class="table table-bordered">
                    <tr>
                        <th class="bg-primary text-white">Jumlah Pelanggan</th>
                        <th class="bg-primary text-white">Jumlah Pendapatan</th>
                    </tr>
                    <tr>
                        <td><?php echo $totalPelanggan; ?> Orang</td>
                        <td>Rp <?php echo number_format($totalPendapatan, 0, ',', '.'); ?></td>
                    </tr>
                </table>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('transaksiChart').getContext('2d');
                var transaksiChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_column($dataTabel, 'waktu_transaksi')); ?>,
                        datasets: [{
                            label: 'Total Transaksi',
                            data: <?php echo json_encode(array_column($dataTabel, 'total')); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
