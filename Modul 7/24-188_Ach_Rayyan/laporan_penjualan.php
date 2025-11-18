<?php
include "koneksi.php";

$show_report = false;
$tgl_mulai = "";
$tgl_selesai = "";
$data_harian = [];
$total_pendapatan = 0;
$total_pelanggan = 0;
$error = '';

if (isset($_GET['filter']) && !empty($_GET['tgl_mulai']) && !empty($_GET['tgl_selesai'])) {
    $tgl_mulai = $_GET['tgl_mulai'];
    $tgl_selesai = $_GET['tgl_selesai'];

    $d1 = DateTime::createFromFormat('Y-m-d', $tgl_mulai);
    $d2 = DateTime::createFromFormat('Y-m-d', $tgl_selesai);
    if (!$d1 || !$d2) {
        $error = "Format tanggal tidak valid (harus YYYY-MM-DD).";
    } elseif ($d1 > $d2) {
        $error = "'Tanggal mulai' tidak boleh setelah 'tanggal selesai'.";
    } else {
        $show_report = true;

        $d1_sql = mysqli_real_escape_string($conn, $d1->format('Y-m-d'));
        $d2_sql = mysqli_real_escape_string($conn, $d2->format('Y-m-d'));

        $sql_harian = "
            SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total_harian
            FROM transaksi
            WHERE DATE(waktu_transaksi) BETWEEN '$d1_sql' AND '$d2_sql'
            GROUP BY DATE(waktu_transaksi)
            ORDER BY DATE(waktu_transaksi) ASC
        ";
        $query_harian = mysqli_query($conn, $sql_harian);
        if ($query_harian === false) {
            $error = "Query data harian error: " . mysqli_error($conn);
            $data_harian = [];
        } else {
            $data_harian = mysqli_fetch_all($query_harian, MYSQLI_ASSOC);
        }

        $sql_total = "
            SELECT COUNT(DISTINCT nama_pelanggan) AS jum_pelanggan, COALESCE(SUM(total),0) AS jum_pendapatan
            FROM transaksi
            WHERE DATE(waktu_transaksi) BETWEEN '$d1_sql' AND '$d2_sql'
        ";
        $query_total = mysqli_query($conn, $sql_total);
        if ($query_total === false) {
            $error = "Query total error: " . mysqli_error($conn);
            $total_pelanggan = 0;
            $total_pendapatan = 0;
        } else {
            $data_total = mysqli_fetch_assoc($query_total);
            $total_pelanggan = (int) ($data_total['jum_pelanggan'] ?? 0);
            $total_pendapatan = (float) ($data_total['jum_pendapatan'] ?? 0);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="report-container">
        
        <div class="report-header-blue">
            <?php if ($show_report): ?>
                Rekap Laporan Penjualan <?= htmlspecialchars($tgl_mulai) ?> sampai <?= htmlspecialchars($tgl_selesai) ?>
            <?php else: ?>
                Rekap Laporan Penjualan
            <?php endif; ?>
        </div>

        <div class="report-body">

            <?php if (!empty($error)): ?>
                <p style="color:red;margin-bottom:12px"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php if (!$show_report): ?>
                
                <a href="index.php" class="btn-back">Kembali</a>
                
                <form action="" method="GET" class="filter-box">
                    <input type="date" name="tgl_mulai" class="input-date" required>
                    <input type="date" name="tgl_selesai" class="input-date" required>
                    <button type="submit" name="filter" value="1" class="btn-excel">Tampilkan</button>
                </form>

            <?php else: ?>

                <a href="laporan_penjualan.php" class="btn-back">&lt; Kembali</a>
                <br>
                <button class="btn-print" onclick="window.print()">Cetak</button>
                <a href="laporan_excel.php?tgl_mulai=<?= urlencode($tgl_mulai) ?>&tgl_selesai=<?= urlencode($tgl_selesai) ?>" class="btn-excel" target="_blank">Excel</a>

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
                                <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                            </tr>
                        <?php 
                            endforeach;
                        else: 
                        ?>
                            <tr><td colspan="3" align="center">Tidak ada data.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="summary-box" style="margin-top:18px">
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
                        <?php 
                        if (!empty($data_harian)) {
                            $arr = [];
                            foreach ($data_harian as $row) {
                                $arr[] = "'" . date('d-m-Y', strtotime($row['tanggal'])) . "'";
                            }
                            echo implode(',', $arr);
                        }
                        ?>
                    ];
                    const dataValues = [
                        <?php
                        if (!empty($data_harian)) {
                            $arr2 = [];
                            foreach ($data_harian as $row) {
                                $arr2[] = (float)$row['total_harian'];
                            }
                            echo implode(',', $arr2);
                        }
                        ?>
                    ];

                    const ctx = document.getElementById('salesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Penjualan (Rp)',
                                data: dataValues,
                                backgroundColor: 'rgba(200, 200, 200, 0.6)',
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
                                            return 'Rp ' + Number(value).toLocaleString();
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
