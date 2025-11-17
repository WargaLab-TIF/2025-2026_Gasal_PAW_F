<?php
    include "conn.php";

    $data_grafik = [];
    $data_tabel = [];

    if (isset($_GET['start']) && isset($_GET['end'])) {
        $start = $_GET['start'];
        $end = $_GET['end'];

        $bahan_chart = mysqli_prepare($conn,
            "SELECT DATE(waktu_transaksi) as tgl, SUM(total) as total_harian
            FROM transaksi
            WHERE DATE(waktu_transaksi) BETWEEN ? and ?
            GROUP BY DATE(waktu_transaksi)
            ORDER BY DATE(waktu_transaksi)"
        );

        mysqli_stmt_bind_param($bahan_chart, "ss", $start, $end);
        mysqli_stmt_execute($bahan_chart);
        $result_bahan = mysqli_stmt_get_result($bahan_chart);

        while ($data = mysqli_fetch_assoc($result_bahan)) {
            $data_grafik[] = $data;
            $data_tabel[] = $data;
        }
    }


    $pelanggan = mysqli_prepare($conn,
        "SELECT COUNT(DISTINCT pelanggan_id) AS total_pelanggan
        FROM transaksi
        WHERE DATE(waktu_transaksi) BETWEEN ? AND ?"
    );
        mysqli_stmt_bind_param($pelanggan, "ss", $start, $end);
        mysqli_stmt_execute($pelanggan);
        $result_pelanggan = mysqli_stmt_get_result($pelanggan);
        $pelanggan_row = mysqli_fetch_assoc($result_pelanggan);
        $total_pelanggan = $pelanggan_row['total_pelanggan'];



    $pendapatan = mysqli_prepare($conn,
        "SELECT SUM(total) AS total_pendapatan
         FROM transaksi
         WHERE DATE(waktu_transaksi) BETWEEN ? AND ?"
    );
    mysqli_stmt_bind_param($pendapatan, "ss", $start, $end);
    mysqli_stmt_execute($pendapatan);
    $result_pendapatan = mysqli_stmt_get_result($pendapatan);
    $pendapatan_row = mysqli_fetch_assoc($result_pendapatan);
    $total_pendapatan = $pendapatan_row['total_pendapatan'] ?? 0;




    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="pdf:filename" content="laporan_penjualan.pdf">
    <title>Laporan_Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
            font-family: Arial, sans-serif;
        }
        h3 {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .card-header {
            font-weight: bold;
        }
        a {
            text-decoration: none;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn a {
            color: white;
            text-decoration: none;
        }
        .btn a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Rekap Laporan Penjualan <?= $start?> sampai <?= $end; ?></h3>
        </div>

        <div class="card-body p-4">

            <a href="index.php" class="btn btn-primary mb-3">Kembali</a>

            <form method="GET" class="mb-4">
                <div class="d-flex gap-2">
                    <input type="date" name="start" >
                    <input type="date" name="end" >
                    <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
                </div>
            </form>


            <div class="d-flex gap-2 mb-3 no-print">
                <button onclick="window.print()" class="btn btn-danger">
                    Cetak PDF
                </button>

                <a href="export_excel.php?start=<?= $start ?>&end=<?= $end ?>" class="btn btn-success">
                    Export Excel
                </a>
            </div>


            <canvas id="chartpenjualan" class="mb-4"></canvas>
            <script>
                const label = <?= json_encode(array_column($data_grafik, "tgl")) ?>;
                const total = <?= json_encode(array_column($data_grafik, "total_harian")) ?>;

                new Chart(document.getElementById('chartpenjualan'), {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Total Penjualan Harian',
                            data: total
                        }]
                    }
                })
            </script>



            <div class="p-3">
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a = 1;?>
                        <?php foreach ($data_tabel as $row): ?>
                            <tr>
                                <td><?= $a ++; ?></td>
                                <td>Rp <?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                                <td><?= $row['tgl'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <div class="p-3 ">
                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Total Pelanggan</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $total_pelanggan ?> Pelanggan</td>
                            <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>