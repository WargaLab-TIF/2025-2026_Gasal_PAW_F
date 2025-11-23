<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

$data_tampil = false;
$tanggal_awal = '';
$tanggal_akhir = '';
$total_pendapatan_tanggal = [];
$tanggal_array = [];

if (isset($_POST['tampilkan'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $data_tampil = true;

    $sql_grafik = "SELECT DATE(t.waktu_transaksi) AS tanggal,
                          SUM(td.qty * td.harga) AS total
                   FROM transaksi t
                   INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
                   WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                   GROUP BY DATE(t.waktu_transaksi)
                   ORDER BY tanggal ASC";
    $result_grafik = mysqli_query($conn, $sql_grafik);
    while ($row = mysqli_fetch_assoc($result_grafik)) {
        $tanggal_array[] = $row['tanggal'];
        $total_pendapatan_tanggal[] = $row['total'];
    }

    $sql_rekap = "SELECT DATE(t.waktu_transaksi) AS tanggal,
                         SUM(td.qty * td.harga) AS total
                  FROM transaksi t
                  INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
                  WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                  GROUP BY DATE(t.waktu_transaksi)
                  ORDER BY tanggal ASC";
    $rekap = mysqli_query($conn, $sql_rekap);

    $sql_total = "SELECT COUNT(DISTINCT t.pelanggan_id) AS total_pelanggan,
                         SUM(td.qty * td.harga) AS total_pendapatan
                  FROM transaksi t
                  INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
                  WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    $total = mysqli_fetch_assoc(mysqli_query($conn, $sql_total));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef4ff;
        }

        .container {
            width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 8px #999;
            text-align: center;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: center;
        }

        h2,
        h3 {
            text-align: center;
        }

        button {
            margin: 5px;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div class="container">
        <?php if (!$data_tampil) { ?>
            <h2>Rekap Laporan Penjualan</h2>
            <form action="admin.php">
                <button>Kembali</button>
            </form>
            <form method="POST">
                <table>
                    <tr>
                        <td>Tanggal Awal</td>
                        <td><input type="date" name="tanggal_awal" required></td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir</td>
                        <td><input type="date" name="tanggal_akhir" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="tampilkan">Tampilkan</button></td>
                    </tr>
                </table>
            </form>
        <?php } else { ?>
            <h2>Rekap Laporan Penjualan<br>(<?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?>)</h2>

            <button onclick="history.back()">⬅ Kembali</button>
            <button onclick="window.print()">Print PDF</button>
            <form action="export_excel.php" method="GET" style="display:inline;">
                <input type="hidden" name="tgl1" value="<?= $tanggal_awal ?>">
                <input type="hidden" name="tgl2" value="<?= $tanggal_akhir ?>">
                <button>Export Excel</button>
            </form>

            <canvas id="chartPenjualan"></canvas>
            <script>
                var ctx = document.getElementById('chartPenjualan');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php foreach ($tanggal_array as $i => $tgl) {
                                        echo "'$tgl'" . ($i < count($tanggal_array) - 1 ? "," : "");
                                    } ?>],
                        datasets: [{
                            label: 'Total Pendapatan',
                            data: [<?php foreach ($total_pendapatan_tanggal as $i => $val) {
                                        echo $val . ($i < count($total_pendapatan_tanggal) - 1 ? "," : "");
                                    } ?>],
                            backgroundColor: 'lightblue'
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

            <h3>Detail Per Tanggal</h3>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
                <?php $no = 1;
                while ($r = mysqli_fetch_assoc($rekap)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r['total'] ?></td>
                        <td><?= $r['tanggal'] ?></td>
                    </tr>
                <?php } ?>
            </table>

            <h3>Ringkasan</h3>
            <table border="1">
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Total Pendapatan</th>
                </tr>
                <tr>
                    <td><?= $total['total_pelanggan'] ?></td>
                    <td><?= $total['total_pendapatan'] ?></td>
                </tr>
            </table>
        <?php } ?>
    </div>
</body>

</html>