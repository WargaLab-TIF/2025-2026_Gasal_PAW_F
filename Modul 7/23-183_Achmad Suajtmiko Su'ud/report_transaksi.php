<?php
// report_transaksi.php
include 'koneksi.php';

// --- 1. Ambil & Tentukan Tanggal Awal dan Akhir ---
$default_start = '2025-11-08';
$default_end = '2025-11-14';

$tanggal_awal = isset($_GET['tanggal_awal']) && $_GET['tanggal_awal'] ? $_GET['tanggal_awal'] : $default_start;
$tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] ? $_GET['tanggal_akhir'] : $default_end;

$is_report_view = isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir']);

$tanggal_awal_display = date('d-m-Y', strtotime($tanggal_awal));
$tanggal_akhir_display = date('d-m-Y', strtotime($tanggal_akhir));


$data_rekap = [];
$labels_chart = [];
$data_chart = [];
$total_pendapatan = 0;
$jumlah_pelanggan = 0;

if ($is_report_view) {
    $sql_rekap = "
        SELECT waktu_transaksi, SUM(total) AS daily_total
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi ASC
    ";
    $stmt_rekap = $koneksi->prepare($sql_rekap);
    $stmt_rekap->bind_param("ss", $tanggal_awal, $tanggal_akhir);
    $stmt_rekap->execute();
    $result_rekap = $stmt_rekap->get_result();

    while ($row = $result_rekap->fetch_assoc()) {
        $data_rekap[] = $row;
        $labels_chart[] = date('Y-m-d', strtotime($row['waktu_transaksi']));
        $data_chart[] = $row['daily_total'];
    }
    $stmt_rekap->close();

    $sql_pendapatan = "SELECT SUM(total) AS total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt_pendapatan = $koneksi->prepare($sql_pendapatan);
    $stmt_pendapatan->bind_param("ss", $tanggal_awal, $tanggal_akhir);
    $stmt_pendapatan->execute();
    $total_pendapatan = $stmt_pendapatan->get_result()->fetch_assoc()['total_pendapatan'] ?? 0;
    $stmt_pendapatan->close();

    $sql_pelanggan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt_pelanggan = $koneksi->prepare($sql_pelanggan);
    $stmt_pelanggan->bind_param("ss", $tanggal_awal, $tanggal_akhir);
    $stmt_pelanggan->execute();
    $jumlah_pelanggan = $stmt_pelanggan->get_result()->fetch_assoc()['jumlah_pelanggan'] ?? 0;
    $stmt_pelanggan->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <?php if ($is_report_view): ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <?php endif; ?>
</head>

<body>

    <div class="header-nav">
        <div class="brand">Penjualan XYZ</div>
        <div class="menu">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="#">Transaksi</a>
        </div>
    </div>

    <div class="report-header">
        Rekap Laporan Penjualan <?php echo $is_report_view ? "$tanggal_awal_display sampai $tanggal_akhir_display" : ""; ?>
    </div>

    <div class="content-container">


        <?php if (!$is_report_view): ?>
            <div class="filter-section mb-4">
                <form method="GET" action="report_transaksi.php" class="filter-form">

                    <a href="javascript:history.back()" class="btn btn-secondary mr-2">
                        < Kembali
                            </a>

                            <input
                                type="date"
                                name="tanggal_awal"
                                class="form-control"
                                value="<?php echo $tanggal_awal; ?>">

                            <input
                                type="date"
                                name="tanggal_akhir"
                                class="form-control mr-2"
                                value="<?php echo $tanggal_akhir; ?>">

                            <button type="submit" class="btn btn-success">
                                Tampilkan
                            </button>
                </form>
            </div>


        <?php else: ?>
            <div class="mb-4 no-print">

                <a href="report_transaksi.php" class="btn btn-secondary mr-3">
                    < Kembali
                        </a>
                        <br> <br>

                        <button type="button" class="btn btn-warning mr-2" onclick="window.print()">Cetak</button>

                        <a href="export_excel.php?tanggal_awal=<?php echo $tanggal_awal; ?>&tanggal_akhir=<?php echo $tanggal_akhir; ?>" class="btn btn-warning">Excel</a>
            </div>

            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>

            <table class="table table-bordered table-striped table-rekap mt-4">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 40%;">Total</th>
                        <th style="width: 55%;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_rekap as $row):
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo formatRupiah($row['daily_total']); ?></td>
                            <td><?php echo date('d M Y', strtotime($row['waktu_transaksi'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($data_rekap)): ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data transaksi dalam rentang tanggal ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <table class="table table-bordered table-total mt-4">
                <thead>
                    <tr>
                        <th colspan="1">Jumlah Pelanggan</th>
                        <th colspan="1">Jumlah Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $jumlah_pelanggan; ?> Orang</td>
                        <td><?php echo formatRupiah($total_pendapatan); ?></td>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>

    </div> <?php if ($is_report_view): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (document.getElementById('salesChart')) {
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($labels_chart); ?>,
                            datasets: [{
                                label: 'Total',
                                data: <?php echo json_encode($data_chart); ?>,
                                backgroundColor: 'rgba(108, 117, 125, 0.7)',
                                borderColor: 'rgba(108, 117, 125, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value, index, ticks) {
                                            return 'Rp' + value.toLocaleString('id-ID', {
                                                minimumFractionDigits: 0
                                            });
                                        }
                                    }
                                },
                                x: {
                                    ticks: {
                                        callback: function(val, index) {
                                            return new Date(this.getLabelForValue(val)).toLocaleDateString('en-CA');
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (context.parsed.y !== null) {
                                                label += new Intl.NumberFormat('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR',
                                                    minimumFractionDigits: 0
                                                }).format(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>