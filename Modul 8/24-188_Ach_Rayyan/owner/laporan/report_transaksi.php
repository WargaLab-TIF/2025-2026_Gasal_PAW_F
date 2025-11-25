<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true || $_SESSION['level'] != 1) {
    header("Location: ../../login.php");
    exit;
}

$nama_user = $_SESSION['username'];

    include "../../koneksi.php";

    $show_report = false;
    $tgl_mulai = "";
    $tgl_selesai = "";
    $data_harian = [];
    $total_pendapatan = 0;
    $total_pelanggan = 0;

    if (isset($_GET['filter']) && !empty($_GET['tgl_mulai']) && !empty($_GET['tgl_selesai'])) {
        $show_report = true;
        $tgl_mulai = $_GET['tgl_mulai'];
        $tgl_selesai = $_GET['tgl_selesai'];

        $sql_harian = "SELECT waktu_transaksi, SUM(total) as total_harian 
                       FROM transaksi 
                       WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'
                       GROUP BY waktu_transaksi 
                       ORDER BY waktu_transaksi ASC";
        $query_harian = mysqli_query($conn, $sql_harian);
        $data_harian = mysqli_fetch_all($query_harian, MYSQLI_ASSOC);

        $sql_total = "SELECT COUNT(DISTINCT pelanggan_id) as jum_pelanggan, SUM(total) as jum_pendapatan 
                      FROM transaksi 
                      WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
        $query_total = mysqli_query($conn, $sql_total);
        $data_total = mysqli_fetch_assoc($query_total);

        $total_pelanggan = $data_total['jum_pelanggan'];
        $total_pendapatan = $data_total['jum_pendapatan'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="../../css/reportStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <a href="../home.php" class="nav-item">Home</a>

            <select onchange="window.location.href=this.value" class="nav-select">
                <option value="">Data Master</option>
                <option value="../barang/barang.php">Data Barang</option>
                <option value="../supplier/supplier.php">Data Supplier</option>
                <option value="../pelanggan/pelanggan.php">Data Pelanggan</option>
                <option value="../user/user.php">Data User</option>
            </select>


            <a href="../transaksi/transaksi.php" class="nav-item">Transaksi</a>
            <a href="report_transaksi.php" class="nav-item">Laporan</a>
        </div>

        <div class="nav-right">
            <select onchange="window.location.href=this.value" class="nav-select">
                <option><?= $nama_user ?></option>
                <option value="../../logout.php">Logout</option>
            </select>
        </div>
    </nav>

    <div class="report-container">
        
        <div class="report-header-blue">
            <?php if ($show_report): ?>
                Rekap Laporan Penjualan <?= $tgl_mulai ?> sampai <?= $tgl_selesai ?>
            <?php else: ?>
                Rekap Laporan Penjualan
            <?php endif; ?>
        </div>

        <div class="report-body">

            <?php if (!$show_report): ?>
                
                <form action="" method="GET" class="filter-box">
                    <input type="date" name="tgl_mulai" class="input-date" required>
                    <input type="date" name="tgl_selesai" class="input-date" required>
                    <button type="submit" name="filter" value="1" class="btn-excel">Tampilkan</button>
                </form>

            <?php else: ?>

                <a href="report_transaksi.php" class="btn-back">&lt; Kembali</a>
                <br>
                <button class="btn-print" onclick="window.print()">Cetak</button>
                <a href="export_excel.php?tgl_mulai=<?= $tgl_mulai ?>&tgl_selesai=<?= $tgl_selesai ?>" class="btn-excel" target="_blank">Excel</a>

                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>

                <table class="table-report">
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
                        if (!empty($data_harian)):
                            foreach ($data_harian as $row): 
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>Rp <?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                                <td><?= date('d M Y', strtotime($row['waktu_transaksi'])) ?></td>
                            </tr>
                        <?php 
                            endforeach;
                        else: 
                        ?>
                            <tr><td colspan="3" align="center">Tidak ada data.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="summary-box">
                    <div class="summary-item">
                        <span class="summary-label">Jumlah Pelanggan</span>
                        <span class="summary-value"><?= $total_pelanggan ?> Orang</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Jumlah Pendapatan</span>
                        <span class="summary-value">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></span>
                    </div>
                </div>

                <script>
                  
                    const labels = [
                        <?php foreach ($data_harian as $row) { echo "'" . date('d-m-Y', strtotime($row['waktu_transaksi'])) . "',"; } ?>
                    ];
                    const dataValues = [
                        <?php foreach ($data_harian as $row) { echo $row['total_harian'] . ","; } ?>
                    ];

                    const ctx = document.getElementById('salesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Penjualan (Rp)',
                                data: dataValues,
                                backgroundColor: 'rgba(200, 200, 200, 0.5)', // Warna abu-abu seperti di gambar
                                borderColor: 'rgba(100, 100, 100, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>

            <?php endif; ?>

        </div>
    </div>

</body>
</html>