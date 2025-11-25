<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}
if (isset($_GET['tampilkan'])) {
    $tgl_mulai = $_GET['tgl_mulai'];
    $tgl_selesai = $_GET['tgl_selesai'];
} else {
    $tgl_mulai = '2023-11-08';   
    $tgl_selesai = '2023-11-14'; 
}

$data_laporan = array();
$total_pelanggan = 0;
$total_pendapatan = 0;
$sql_harian = "SELECT DATE(waktu_transaksi) as tanggal, SUM(total) as total_harian FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai' GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC";

$query_harian = mysqli_query($koneksi, $sql_harian);
while ($row = mysqli_fetch_assoc($query_harian)) {
    $data_laporan[] = $row;
}

$sql_total = "SELECT COUNT(DISTINCT nama_pelanggan) as total_pelanggan, SUM(total) as total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
$query_total = mysqli_query($koneksi, $sql_total);
$hasil_total = mysqli_fetch_assoc($query_total);
$total_pelanggan = $hasil_total['total_pelanggan'];
$total_pendapatan = $hasil_total['total_pendapatan'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f0f2f5; color: #333; }
        .navbar { background-color: #343a40; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .navbar-brand { color: #ffffff; font-size: 1.25rem; text-decoration: none; font-weight: bold; }
        .navbar-nav { list-style: none; display: flex; margin: 0; padding: 0; }
        .nav-item { margin-left: 15px; }
        .nav-link { color: #ffffff; text-decoration: none; }
        .container-fluid { padding: 20px; }
        .card { background-color: #ffffff; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header-bar { background-color: #007bff; color: white; padding: 10px 15px; font-size: 1.25rem; border-top-left-radius: 5px; border-top-right-radius: 5px; }
        .card-body { padding: 20px; }
        .mb-3 { margin-bottom: 16px; }
        .btn { display: inline-block; padding: 8px 12px; font-size: 14px; text-decoration: none; border-radius: 4px; cursor: pointer; border: 1px solid transparent; color: white; }
        .btn-kembali { background-color: #007bff; border-color: #007bff; }
        .btn-tampilkan { background-color: #28a745; border-color: #28a745; }
        .btn-cetak { background-color: #ffc107; border-color: #ffc107; color: #212529; }
        .btn-excel { background-color: #17a2b8; border-color: #17a2b8; }
        .form-filter { display: flex; align-items: center; }
        .form-filter input[type="date"] { padding: 7px 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; margin-right: 15px; }
        .form-filter .btn-tampilkan { margin-left: 10px; }
        hr { border: 0; border-top: 1px solid #eee; margin: 20px 0; }
        h5 { font-size: 18px; margin-top: 25px; margin-bottom: 10px; }
        .table-rekap { width: 100%; border-collapse: collapse; }
        .table-rekap th, .table-rekap td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table-rekap th { background-color: #007bff; color: white; font-weight: bold; }
        .table-total { width: 50%; max-width: 500px; }
        .chart-container { position: relative; width: 100%; max-width: 800px; margin: 20px auto 30px auto; aspect-ratio: 2 / 1; }
        @media print { .navbar, .form-filter, .btn, .header-bar, hr { display: none; } .card { border: none; box-shadow: none; } .container-fluid { padding: 0; } .chart-container { width: 100% !important; max-width: none !important; aspect-ratio: 2 / 1 !important; height: auto !important; page-break-inside: avoid; } }
    </style>
</head>
<body>
    <nav class="navbar">
      <a class="navbar-brand" href="#">Penjualan XYZ</a>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="data_supplier.php">Supplier</a></li>
        <li class="nav-item"><a class="nav-link" href="data_barang.php">Barang</a></li>
        <li class="nav-item"><a class="nav-link" href="transaksi.php">Transaksi</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
        <div class="card">
            <div class="header-bar">
                Rekap Laporan Penjualan <?php echo $tgl_mulai; ?> sampai <?php echo $tgl_selesai; ?>
            </div>
            <div class="card-body">
                <a href="transaksi.php" class="btn btn-kembali mb-3">< Kembali</a>
                
                <form action="" method="GET" class="form-filter">
                    <input type="date" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>">
                    <input type="date" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>">
                    <button type="submit" name="tampilkan" class="btn btn-tampilkan">Tampilkan</button>
                </form>
                
                <hr> 
                <div class="mb-3">
                    <button onclick="window.print()" class="btn btn-cetak">Cetak</button>
                    <a href="header.php?tgl_mulai=<?php echo $tgl_mulai; ?>&tgl_selesai=<?php echo $tgl_selesai; ?>" 
                       target="_blank" class="btn btn-excel">Excel</a>
                </div>
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                    <h5>Tabel Rekap Harian</h5>
                    <table class="table-rekap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data_laporan)): ?>
                                <tr>
                                    <td colspan="3">Tidak ada data pada rentang tanggal ini.</td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                $no = 1;
                                foreach ($data_laporan as $data): 
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>Rp<?php echo number_format($data['total_harian'], 0, ',', '.'); ?></td>
                                    <td><?php echo date('d M Y', strtotime($data['tanggal'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <h5 class="mt-4">Total Keseluruhan</h5>
                    <table class="table-rekap table-total">
                        <thead>
                            <tr>
                                <th>Jumlah Pelanggan</th>
                                <th>Jumlah Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $total_pelanggan; ?> Orang</td>
                                <td>Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script>
        <?php if (!empty($data_laporan)): ?>
            var labels_grafik = <?php echo json_encode(array_column($data_laporan, 'tanggal')); ?>;
            var data_grafik = <?php echo json_encode(array_column($data_laporan, 'total_harian')); ?>;
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', 
                data: {
                    labels: labels_grafik, 
                    datasets: [{
                        label: 'Total', 
                        data: data_grafik, 
                        backgroundColor: 'rgba(54, 162, 235, 0.6)', 
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false, 
                    animation: { duration: 0 },
                    scales: { y: { beginAtZero: true } }
                }
            });
        <?php endif;?>
    </script>
</body>
</html>