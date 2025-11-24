<?php
include "koneksi.php";

$tgl_awal = isset($_POST['tgl_awal']) ? mysqli_real_escape_string($koneksi, $_POST['tgl_awal']) : date('Y-m-01');
$tgl_akhir = isset($_POST['tgl_akhir']) ? mysqli_real_escape_string($koneksi, $_POST['tgl_akhir']) : date('Y-m-d');


$sql_ringkasan = "SELECT 
    COUNT(t.id) AS jumlah_transaksi, 
    SUM(t.total) AS total_pendapatan
    FROM transaksi t
    WHERE DATE(t.waktu_transaksi) BETWEEN '$tgl_awal' AND '$tgl_akhir'";

$result_ringkasan = mysqli_query($koneksi, $sql_ringkasan);
$ringkasan = mysqli_fetch_assoc($result_ringkasan);

$jumlah_transaksi = $ringkasan['jumlah_transaksi'];
$total_pendapatan_rp = "Rp. " . number_format($ringkasan['total_pendapatan'], 0, ',', '.'); 

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

$sql_laporan = "SELECT 
            t.id, 
            t.waktu_transaksi, 
            p.nama AS nama_pelanggan, 
            u.username AS nama_user, 
            t.total
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
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>
<body style="font-family: Arial, sans-serif;">

<table width="100%" bgcolor="black" cellpadding="10">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="dashboard.php" style="color:white; text-decoration:none;"><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>
<div style="padding: 20px;">
    <h1 align="center">LAPORAN TRANSAKSI PENJUALAN</h1>
    <form method="POST" action="laporan.php" style="margin-bottom: 20px;">
        <fieldset>
            <legend>Filter Periode Laporan</legend>
            <label for="tgl_awal">Dari Tanggal:</label>
            <input type="date" id="tgl_awal" name="tgl_awal" value="<?php echo $tgl_awal; ?>" required>
            
            <label for="tgl_akhir">Sampai Tanggal:</label>
            <input type="date" id="tgl_akhir" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>" required>
            
            <button type="submit" style="background-color: limegreen; color: white; font-size:14px; padding: 10px 15px; text-decoration: none; border-radius: 4px; border-color: limegreen; margin-right: 5px; margin-left: 10px;">
            <b>Tampilkan Laporan</b></button>

            <button 
                type="button" 
                onclick="window.location.href='cetak_laporan.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>'"
                style="background-color: orange; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; border-color: orange; margin-right: 5px; margin-left: 10px;">
                <b>Cetak Laporan</b>
            </button>
            
            <button 
                type="button" 
                onclick="window.location.href='export_excel.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>'"
                style="background-color: gold; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; border-color: gold; margin-right: 5px; margin-left: 10px;">
                <b>Export ke Excel</b>
            </button>
        </fieldset>
    </form>
    <hr>
    <h2>Grafik Pendapatan Harian</h2>
    <div style="width: 75%; margin: auto;">
        <canvas id="pendapatanChart"></canvas> 
    </div>
    <hr>
    <h2>Ringkasan Periode (<?php echo date('d/m/Y', strtotime($tgl_awal)); ?> s/d <?php echo date('d/m/Y', strtotime($tgl_akhir)); ?>)</h2>
    <table border="1" cellpadding="8" width="30%">
        <tr>
            <td>Jumlah Transaksi</td>
            <td align="right"><?php echo $jumlah_transaksi; ?></td>
        </tr>
        <tr>
            <td>TOTAL PENDAPATAN</td>
            <td align="right"><?php echo $total_pendapatan_rp; ?></td>
        </tr>
    </table>
    <hr>
    <h2>Detail Transaksi</h2>
    <table border="1" cellpadding="8" width="80%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="15%">Tanggal & Waktu</th>
                <th width="25%">Pelanggan</th>
                <th width="20%">Kasir/User</th>
                <th width="15%">Total Bayar</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if (mysqli_num_rows($result_laporan) > 0) {
            while ($d = mysqli_fetch_assoc($result_laporan)) {
                $id_transaksi = htmlspecialchars($d['id']);
                $waktu = date('d/m/Y H:i', strtotime($d['waktu_transaksi'])); 
                $total_bayar = "Rp " . number_format($d['total'], 0, ',', '.'); 
                $nama_pelanggan = !empty($d['nama_pelanggan']) ? htmlspecialchars($d['nama_pelanggan']) : 'Umum';

                echo "
                <tr align='center'>
                    <td>{$no}.</td>
                    <td>{$waktu}</td>
                    <td align='left'>{$nama_pelanggan}</td>
                    <td>" . htmlspecialchars($d['nama_user']) . "</td>
                    <td align='right'>{$total_bayar}</td>
                    <td>
                        <a href='detail_transaksi.php?id={$id_transaksi}'
                        style='background-color: gold; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px; margin-right: 5px;'>
                            Detail
                        </a>
                    </td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='6' align='center'>Tidak ada transaksi pada periode ini.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    const labels = <?php echo json_encode($chart_labels); ?>;
    const dataPendapatan = <?php echo json_encode($chart_data); ?>;

    document.addEventListener('DOMContentLoaded', function() {
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
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Pendapatan (Rp)'
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    return 'Rp ' + value.toLocaleString('id-ID'); 
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Tren Pendapatan Harian'
                        }
                    }
                }
            });
        }
    });
</script>
</body>
</html>