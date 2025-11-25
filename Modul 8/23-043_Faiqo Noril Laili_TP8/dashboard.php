<?php
include 'koneksi.php';
include 'navbar.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$jumlah_pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pelanggan"))['total'];
$jumlah_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user"))['total'];
$jumlah_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM barang"))['total'];

$transaksi_query = "SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total FROM transaksi GROUP BY DATE(waktu_transaksi)";
$transaksi_result = mysqli_query($koneksi, $transaksi_query);

$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($transaksi_result)) {
    $labels[] = $row['tanggal'];
    $data[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Pelanggan</h5>
                        <p class="card-text fs-3"><?php echo $jumlah_pelanggan; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-shield"></i> User</h5>
                        <p class="card-text fs-3"><?php echo $jumlah_user; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-box"></i> Barang</h5>
                        <p class="card-text fs-3"><?php echo $jumlah_barang; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                Grafik Transaksi
            </div>
            <div class="card-body">
                <canvas id="transaksiChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        const transaksiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Transaksi (Rp)',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
