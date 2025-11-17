<?php
include "koneksi.php"; 

$tgl_awal = $_GET['tgl_awal'] ?? null;
$tgl_akhir = $_GET['tgl_akhir'] ?? null;

$filter_aktif = ($tgl_awal && $tgl_akhir);
$data_rekap = [];
$total_pendapatan = 0;
$total_pelanggan = 0;

if ($filter_aktif) {
    $tgl_awal_sql = mysqli_real_escape_string($conn, $tgl_awal);
    $tgl_akhir_sql = mysqli_real_escape_string($conn, $tgl_akhir);
    
    $tgl_awal_range = "$tgl_awal_sql";
    $tgl_akhir_range = "$tgl_akhir_sql";

    $sql = "SELECT DATE(waktu_transaksi) AS tanggal_transaksi,
            SUM(total) AS total_harian
            FROM transaksi
            WHERE waktu_transaksi BETWEEN '$tgl_awal_range' AND '$tgl_akhir_range'
            GROUP BY tanggal_transaksi
            ORDER BY tanggal_transaksi ASC"; 

    $result = mysqli_query($conn, $sql) or die("Query gagal: " . mysqli_error($conn));

    while($row = mysqli_fetch_assoc($result)) {
        $data_rekap[] = $row;
        $total_pendapatan += $row['total_harian'];
    }
    $sql_pelanggan = "SELECT COUNT(DISTINCT id) AS total_pelanggan
                      FROM transaksi
                      WHERE waktu_transaksi BETWEEN '$tgl_awal_range' AND '$tgl_akhir_range'";
    
    $result_pelanggan = mysqli_query($conn, $sql_pelanggan);
    if ($result_pelanggan) {
        $data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
        $total_pelanggan = $data_pelanggan['total_pelanggan'];
    }
}

$tgl_awal_display = $tgl_awal ? date('d/m/Y', strtotime($tgl_awal)) : '';
$tgl_akhir_display = $tgl_akhir ? date('d/m/Y', strtotime($tgl_akhir)) : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: 0 auto; }
        
        .card {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            margin-bottom: 30px;
        }
        .card-header {
            background-color: blue; 
            color: white;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .card-body {
            padding: 20px;
        }
        
        .filter { display: flex; gap: 10px; align-items: center; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .buttons { margin-left: auto; display: flex; gap: 10px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .summary-table td:first-child { background-color: #e9ecef; font-weight: bold; } 

        @media print { 
            .filter { display: none; } 
            .card { box-shadow: none; border: none; }
            .card-header { background-color: white !important; color: black !important; border-bottom: 1px solid black; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Rekap Laporan Penjualan
            <?php if($filter_aktif) echo " (" . htmlspecialchars($tgl_awal_display) . " s/d " . htmlspecialchars($tgl_akhir_display) . ")"; ?>
        </div>

        <div class="card-body">
            <div class="filter">
                <a href="master_transaksi.php" style="padding: 8px 10px; text-decoration: none; background-color: blue; color: white; border-radius: 4px;">
                    &lt; Kembali
                </a>
                
                <form method="GET" action="report_transaksi.php" style="display: contents;">
                    <input type="date" name="tgl_awal" value="<?php echo htmlspecialchars($tgl_awal ?? ''); ?>" required style="padding: 8px; border: 1px solid #ccc;">
                    <input type="date" name="tgl_akhir" value="<?php echo htmlspecialchars($tgl_akhir ?? ''); ?>" required style="padding: 8px; border: 1px solid #ccc;">
                    <button type="submit" style="padding: 8px 10px; background-color: limegreen; color: white; border: none; border-radius: 4px;">Tampilkan</button>
                </form>
                
                <?php if ($filter_aktif): ?>
                <div class="buttons">
                    <a href="javascript:void(0)" onclick="window.print()" style="padding: 8px 10px; text-decoration: none; background-color: gold; color: black; border-radius: 4px;">Cetak</a>
                    <a href="report_excel.php?tgl_awal=<?php echo htmlspecialchars($tgl_awal); ?>&tgl_akhir=<?php echo htmlspecialchars($tgl_akhir); ?>" style="padding: 8px 10px; text-decoration: none; background-color: gold; color: black; border-radius: 4px;">Excel</a>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if ($filter_aktif && !empty($data_rekap)): ?>
                
                <h4 style="text-align: center; margin-top: 30px;">Grafik Penjualan Harian</h4>
                <div style="width: 100%; margin: 20px 0;">
                    <canvas id="grafikPenjualan" style="max-height: 400px;"></canvas>
                </div>
                
                <hr>
                
                <h4 style="margin-top: 30px;">Detail Penjualan Harian</h4>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        foreach($data_rekap as $row) {
                            $total_rupiah = "Rp" . number_format($row['total_harian'], 0, ',', '.');
                            $tgl_display = date('d M Y', strtotime($row['tanggal_transaksi']));

                            echo "<tr>";
                            echo "<td>" . $counter++ . "</td>";
                            echo "<td>" . $tgl_display . "</td>";
                            echo "<td style='text-align: right;'>" . $total_rupiah . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h4 style="margin-top: 30px;">Ringkasan Total</h4>
                <table class="summary-table" style="max-width: 400px; margin-right: auto; margin-left: 0;">
                    <tbody>
                        <tr>
                            <td>Total Pelanggan Unik</td>
                            <td style="text-align: center;"><?php echo number_format($total_pelanggan, 0, ',', '.'); ?> Pelanggan</td>
                        </tr>
                        <tr>
                            <td>Total Pendapatan</td>
                            <td style="text-align: center;">Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>

                <script>
                    const labels = [<?php echo "'" . implode("','", array_map(function($d) { return date('d-M', strtotime($d['tanggal_transaksi'])); }, $data_rekap)) . "'"; ?>];
                    const dataValues = [<?php echo implode(",", array_column($data_rekap, 'total_harian')); ?>];

                    new Chart(document.getElementById('grafikPenjualan'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Penjualan (Rp)',
                                data: dataValues,
                                backgroundColor: 'grey',
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: { y: { beginAtZero: true } },
                            plugins: { legend: { display: false } }
                        }
                    });
                </script>
                
            <?php elseif ($filter_aktif && empty($data_rekap)): ?>
                <p style="text-align: center; color: red;">Tidak ada data transaksi ditemukan pada periode ini.</p>
            <?php else: ?>
                <p style="text-align: center;">Silakan pilih tanggal awal dan tanggal akhir untuk melihat laporan penjualan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>