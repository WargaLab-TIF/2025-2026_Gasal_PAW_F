<?php
include 'koneksi.php'; 
if(!isset($_SESSION['level']) || ($_SESSION['level'] != 1 && $_SESSION['level'] != 2)) {
    header("location:index.php?pesan=akses_ditolak");
    exit();
}
$mulai   = isset($_GET['mulai']) ? $_GET['mulai'] : date('Y-m-01');
$selesai = isset($_GET['selesai']) ? $_GET['selesai'] : date('Y-m-d');
$dataTransaksi = [];
$labelsChart   = [];
$dataChart     = [];
$totalPendapatan = 0;
$pelangganUnik = [];
$query = "SELECT t.*, p.nama_pelanggan 
          FROM transaksi t 
          LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
          WHERE DATE(t.waktu_transaksi) BETWEEN '$mulai' AND '$selesai' 
          ORDER BY t.waktu_transaksi ASC";

$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}
while ($row = mysqli_fetch_assoc($result)) {
    $row['nama_pelanggan'] = $row['nama_pelanggan'] ?? 'Non-Member/Umum';
    $dataTransaksi[] = $row;
    $totalPendapatan += $row['total'];
    if ($row['id_pelanggan']) {
        $pelangganUnik[$row['id_pelanggan']] = true;
    }
    $tgl = date('d-m-Y', strtotime($row['waktu_transaksi']));
    if (!isset($dataChart[$tgl])) {
        $dataChart[$tgl] = 0;
        $labelsChart[] = $tgl; 
    }
    $dataChart[$tgl] += $row['total'];
}
$chartValues = array_values($dataChart); 
$chartLabels = array_keys($dataChart);   
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
/* =====[ GLOBAL STYLE ]===== */
body {
    background: #f4f4f4;
    margin: 0;
    font-family: Arial, sans-serif;
    color: #333;
}

/* Container Utama */
.wrapper {
    max-width: 1100px;
    margin: 25px auto;
    padding: 10px;
}

/* =====[ CARD ]===== */
.box {
    background: #fff;
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.box-header {
    background: #007bff;
    color: #fff;
    padding: 14px 20px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 8px 8px 0 0;
}

.box-body {
    padding: 20px;
}

/* =====[ FORM ]===== */
.form-inline {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.form-inline input[type="date"] {
    padding: 7px 10px;
    border-radius: 5px;
    border: 1px solid #bbb;
    font-size: 14px;
}

.btn {
    padding: 7px 15px;
    border-radius: 5px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
    font-size: 14px;
}

.btn-info { background: #17a2b8; color: #fff; }
.btn-info:hover { background: #138496; }

.btn-secondary { background: #6c757d; color: #fff; }
.btn-secondary:hover { background: #545b62; }

.btn-success { background: #28a745; color: #fff; }
.btn-success:hover { background: #1e7e34; }

/* =====[ ALERT ]===== */
.alert {
    padding: 13px;
    border-radius: 5px;
    text-align: center;
    margin: 20px 0;
    font-size: 15px;
}

.alert-info {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

/* =====[ STATISTIC BOX ]===== */
.row {
    display: flex;
    gap: 2%;
    margin-bottom: 20px;
}

.col-3 {
    flex: 1;
}

.stat-box {
    padding: 15px 10px;
    border-radius: 6px;
    text-align: center;
    border: 1px solid #ddd;
}

.bg-light { background: #f8f9fa; }
.bg-green { background: #28a745; color: white; }

/* =====[ TABLE ]===== */
.table-wrapper {
    overflow-x: auto;
    margin-top: 15px;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.table th {
    background: #343a40;
    color: #fff;
    text-align: center;
}

.table tfoot td {
    background: #e9ecef;
    font-weight: bold;
}

/* Helpers */
.text-center { text-align: center; }
.text-right { text-align: right; }

/* =====[ PRINT ]===== */
@media print {
    .no-print { display: none !important; }
    body { background: white; }
    .box { border: none; box-shadow: none; }
}

    </style>
</head>
<body class="bg-light">

<div class="container mt-4 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Laporan Rekap Penjualan</h5>
        </div>
        <div class="card-body">
            
            <form method="GET" action="" class="form-inline mb-4 no-print">
                <?php if(isset($_GET['page'])): ?>
                    <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
                <?php endif; ?>

                <label class="mr-2 font-weight-bold">Periode:</label>
                <input type="date" name="mulai" class="form-control mr-2" value="<?= $mulai; ?>" required>
                <span class="mr-2">s/d</span>
                <input type="date" name="selesai" class="form-control mr-3" value="<?= $selesai; ?>" required>
                <button type="submit" class="btn btn-info">Tampilkan</button>
            </form>

            <div class="mb-4 no-print">
                <button onclick="window.print()" class="btn btn-secondary btn-sm">
                    <i class="fa fa-print"></i> Cetak Laporan
                </button>
                <a href="laporan/cetak_excel.php?mulai=<?= $mulai; ?>&selesai=<?= $selesai; ?>" target="_blank" class="btn btn-success btn-sm">
                    Export Excel
                </a>
            </div>

            <div class="alert alert-info text-center">
                Laporan Penjualan Periode: <strong><?= date('d F Y', strtotime($mulai)); ?></strong> s/d <strong><?= date('d F Y', strtotime($selesai)); ?></strong>
            </div>

            <?php if (!empty($dataTransaksi)): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <canvas id="grafikPenjualan" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row text-center mb-4">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <small>Total Transaksi</small>
                            <h4 class="font-weight-bold"><?= count($dataTransaksi); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <small>Pelanggan Unik</small>
                            <h4 class="font-weight-bold"><?= count($pelangganUnik); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body py-2">
                            <small>Total Omset</small>
                            <h4 class="font-weight-bold">Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Waktu Transaksi</th>
                            <th>Pelanggan</th>
                            <th>Keterangan</th>
                            <th width="20%">Total Belanja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dataTransaksi)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i>Tidak ada data transaksi pada periode ini.</i>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php 
                            $no = 1; 
                            foreach ($dataTransaksi as $dt): 
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= date('d-m-Y H:i', strtotime($dt['waktu_transaksi'])); ?></td>
                                <td><?= htmlspecialchars($dt['nama_pelanggan']); ?></td>
                                <td><?= htmlspecialchars($dt['keterangan']); ?></td>
                                <td class="text-right">Rp <?= number_format($dt['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($dataTransaksi)): ?>
                    <tfoot>
                        <tr class="bg-light font-weight-bold">
                            <td colspan="4" class="text-right">GRAND TOTAL</td>
                            <td class="text-right">Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    // Script Chart.js
    <?php if (!empty($chartLabels)): ?>
    var ctx = document.getElementById('grafikPenjualan').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartLabels); ?>,
            datasets: [{
                label: 'Omset Harian (Rp)',
                data: <?= json_encode($chartValues); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
    <?php endif; ?>
</script>

</body>
</html>