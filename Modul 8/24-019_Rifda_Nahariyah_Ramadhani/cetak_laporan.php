<?php
include "koneksi.php";

$tgl_awal = isset($_GET['tgl_awal']) ? mysqli_real_escape_string($koneksi, $_GET['tgl_awal']) : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? mysqli_real_escape_string($koneksi, $_GET['tgl_akhir']) : date('Y-m-d');

$sql_ringkasan = "SELECT 
    COUNT(t.id) AS jumlah_transaksi, 
    SUM(t.total) AS total_pendapatan
    FROM transaksi t
    WHERE DATE(t.waktu_transaksi) BETWEEN '$tgl_awal' AND '$tgl_akhir'";

$result_ringkasan = mysqli_query($koneksi, $sql_ringkasan);
$ringkasan = mysqli_fetch_assoc($result_ringkasan);

$jumlah_transaksi = $ringkasan['jumlah_transaksi'];
$total_pendapatan_rp = "Rp " . number_format($ringkasan['total_pendapatan'], 0, ',', '.'); 

$sql_chart_data = "SELECT 
    DATE(waktu_transaksi) AS tanggal_transaksi,
    SUM(total) AS total_harian
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$tgl_awal' AND '$tgl_akhir'
    GROUP BY tanggal_transaksi
    ORDER BY tanggal_transaksi ASC";

$result_chart = mysqli_query($koneksi, $sql_chart_data);
$chart_labels = [];
$chart_data = [];
if ($result_chart && mysqli_num_rows($result_chart) > 0) {
    while ($row = mysqli_fetch_assoc($result_chart)) {
        $chart_labels[] = date('d/m', strtotime($row['tanggal_transaksi'])); 
        $chart_data[] = (float)$row['total_harian'];
    }
}
$sql_laporan = "SELECT t.id, t.waktu_transaksi, p.nama AS nama_pelanggan, u.username AS nama_user, t.total
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        LEFT JOIN user u ON t.id = u.id_user
        WHERE DATE(t.waktu_transaksi) BETWEEN '$tgl_awal' AND '$tgl_akhir'
        ORDER BY t.waktu_transaksi ASC"; 

$result_laporan = mysqli_query($koneksi, $sql_laporan);

if (!$result_laporan) {
    die("Query laporan gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan (<?php echo date('d-m-Y', strtotime($tgl_awal)); ?> s/d <?php echo date('d-m-Y', strtotime($tgl_akhir)); ?>)</title>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body style="font-family: Arial;">

<div align="center">
    <h1>LAPORAN TRANSAKSI PENJUALAN</h1>
    <p>
        Periode: <?php echo date('d/m/Y', strtotime($tgl_awal)); ?> s/d <?php echo date('d/m/Y', strtotime($tgl_akhir)); ?>
    </p>
</div>
<hr>
<h2 align="center">Ringkasan Pendapatan</h2>
<table border="1" cellpadding="10" width="50%" align="center">
    <tr>
        <td width="70%">Jumlah Transaksi</td>
        <td width="30%" align="right"><?php echo $jumlah_transaksi; ?></td>
    </tr>
    <tr>
        <td>Total Pendapatan</td>
        <td align="right"><?php echo $total_pendapatan_rp; ?></td>
    </tr>
</table>
<hr>
<h2 align="center">Grafik Pendapatan Harian</h2>
<div align="center" width="80%">
    <canvas id="pendapatanChart" width="700" height="400"></canvas> 
</div>
<hr>
<h2 align="center">Detail Transaksi</h2>
<table border="1" cellpadding="8" width="80%" align="center">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="15%">Tanggal & Waktu</th>
            <th width="25%">Pelanggan</th>
            <th width="20%">Kasir/User</th>
            <th width="15%">Total Bayar</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    if (mysqli_num_rows($result_laporan) > 0) {
        while ($d = mysqli_fetch_assoc($result_laporan)) {
            $waktu = date('d/m/Y', strtotime($d['waktu_transaksi'])); 
            $total_bayar = "Rp " . number_format($d['total'], 0, ',', '.'); 
            $nama_pelanggan = !empty($d['nama_pelanggan']) ? htmlspecialchars($d['nama_pelanggan']) : 'Umum';

            echo "
            <tr>
                <td align='center'>{$no}.</td>
                <td>{$waktu}</td>
                <td>{$nama_pelanggan}</td>
                <td>" . htmlspecialchars($d['nama_user']) . "</td>
                <td align='right'>{$total_bayar}</td>
            </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='5' align='center'>Tidak ada transaksi pada periode ini.</td></tr>";
    }
    ?>
    </tbody>
</table>
<br><br>

<script>
    const labels = <?php echo json_encode($chart_labels); ?>;
    const dataPendapatan = <?php echo json_encode($chart_data); ?>;

    function renderChartAndPrint() {
        const ctx = document.getElementById('pendapatanChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar', 
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Pendapatan (Rp)',
                        data: dataPendapatan,
                        backgroundColor: 'rgba(255, 165, 0, 0.2)',
                        borderColor: 'rgba(255, 140, 0, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    animation: false, 
                    responsive: false, 
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp ' + value.toLocaleString('id-ID'); 
                                }
                            }
                        }
                    },
                    plugins: {
                        title: { display: true, text: 'Tren Pendapatan Harian' }
                    }
                }
            });
        }
        setTimeout(function() {
            window.print();
        }, 500); 
    }
    document.addEventListener('DOMContentLoaded', renderChartAndPrint);
</script>
</body>
</html>