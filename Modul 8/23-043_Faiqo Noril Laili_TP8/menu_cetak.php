<?php
include 'koneksi.php';

$tanggal_awal = $_GET['start_date'];
$tanggal_akhir = $_GET['end_date'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" type="text/css" href="css/cetak.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">

        <h1>Rekap Laporan Penjualan 
            <span><?= $tanggal_awal ?> sampai <?= $tanggal_akhir ?></span>
        </h1>

        <a href="menu_utama.php"><button class="kembali">Kembali</button></a>
        <button class="print" onclick="window.print()">Cetak</button>

        <a href="menu_excel.php?start_date=<?= $tanggal_awal ?>&end_date=<?= $tanggal_akhir ?>" target="_blank">
            <button class="print">Excel</button>
        </a>

        <canvas id="myChart"></canvas>

        <?php
        // QUERY UNTUK CHART
        $qChart = mysqli_query($koneksi, 
            "SELECT waktu_transaksi, SUM(total) AS total
             FROM transaksi
             WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
             GROUP BY waktu_transaksi
             ORDER BY waktu_transaksi"
        );

        $tanggal = [];
        $total = [];

        while ($row = mysqli_fetch_assoc($qChart)) {
            $tanggal[] = $row['waktu_transaksi'];
            $total[] = $row['total'];
        }
        ?>

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($tanggal) ?>,
                    datasets: [{
                        label: 'Total',
                        data: <?= json_encode($total) ?>,
                        backgroundColor: 'rgba(0, 123, 255, 0.3)',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>

        <br><br>

        <table>
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Waktu Transaksi</th>
            </tr>

            <?php
            $sql = "SELECT waktu_transaksi, total 
                    FROM transaksi 
                    WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                    ORDER BY waktu_transaksi";

            $result = mysqli_query($koneksi, $sql);
            $no = 1;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $no++ . "</td>
                            <td>Rp." . number_format($row["total"], 0, ',', '.') . "</td>
                            <td>" . $row["waktu_transaksi"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
            }
            ?>
        </table>

        <br><br>

        <table border="1">
            <tr>
                <th>Jumlah Pelanggan</th>
                <th>Jumlah Pendapatan</th>
            </tr>

            <?php
            $qPendapatan = mysqli_query($koneksi, 
                "SELECT SUM(total) AS pendapatan 
                 FROM transaksi 
                 WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"
            );

            $qPelanggan = mysqli_query($koneksi, 
                "SELECT COUNT(*) AS pelanggan 
                 FROM transaksi 
                 WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"
            );

            $pendapatan = mysqli_fetch_assoc($qPendapatan)['pendapatan'];
            $pelanggan = mysqli_fetch_assoc($qPelanggan)['pelanggan'];
            ?>

            <tr>
                <td><?= $pelanggan ?> Orang</td>
                <td>Rp. <?= number_format($pendapatan, 0, ',', '.') ?></td>
            </tr>
        </table>

    </div>
</body>

</html>
