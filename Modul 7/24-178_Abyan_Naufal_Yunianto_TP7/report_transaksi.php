<?php
// report_transaksi.php

include 'koneksi.php'; // Menggunakan koneksi.php
$data_laporan = [];
$total_pelanggan = 0;
$total_pendapatan = 0;
$tanggal_awal = '';
$tanggal_akhir = '';
$tampilkan_laporan = false;

// Proses Filter Tanggal
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    // Penggunaan real_escape_string untuk sanitasi input
    $tanggal_awal = $koneksi->real_escape_string($_GET['start_date']);
    $tanggal_akhir = $koneksi->real_escape_string($_GET['end_date']);
    $tanggal_awal_db = date('Y-m-d', strtotime($tanggal_awal));
    $tanggal_akhir_db = date('Y-m-d', strtotime($tanggal_akhir));
    $tampilkan_laporan = true;

    // A. Query untuk Rekap Harian (Grafik & Tabel)
    $query_rekap = "SELECT 
                        waktu_transaksi AS Tanggal, 
                        SUM(total) AS TotalHarian
                    FROM 
                        transaksi
                    WHERE 
                        waktu_transaksi BETWEEN '$tanggal_awal_db' AND '$tanggal_akhir_db'
                    GROUP BY 
                        waktu_transaksi
                    ORDER BY 
                        waktu_transaksi ASC";
    
    $hasil_rekap = $koneksi->query($query_rekap);
    
    if ($hasil_rekap->num_rows > 0) {
        $i = 1;
        while ($baris = $hasil_rekap->fetch_assoc()) {
            // Data Total diubah ke integer murni untuk grafik
            $data_laporan[] = [
                'No' => $i++,
                'Total' => (int)$baris['TotalHarian'], 
                'Tanggal' => $baris['Tanggal']
            ];
            $total_pendapatan += $baris['TotalHarian'];
        }
    }

    // B. Query untuk Total Pelanggan
    $query_pelanggan = "SELECT 
                            COUNT(DISTINCT pelanggan_id) AS JumlahPelanggan
                        FROM 
                            transaksi
                        WHERE 
                            waktu_transaksi BETWEEN '$tanggal_awal_db' AND '$tanggal_akhir_db'";
    
    $hasil_pelanggan = $koneksi->query($query_pelanggan);
    $baris_pelanggan = $hasil_pelanggan->fetch_assoc();
    $total_pelanggan = $baris_pelanggan['JumlahPelanggan'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Rekap Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css"> <style>
        /* Tetap sisakan style spesifik (seperti media query untuk print) */
        @media print {
            .menu, .filter-form { display: none; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2>Rekap Laporan Penjualan</h2>
        <div class="menu">
            <a href="index.php" class="btn">⬅ Kembali</a> </div>

        <form method="GET" class="filter-form"> <input type="date" name="start_date" value="<?php echo htmlspecialchars($tanggal_awal); ?>" required>
            <span>sampai</span>
            <input type="date" name="end_date" value="<?php echo htmlspecialchars($tanggal_akhir); ?>" required>
            <button type="submit" class="btn-tampilkan">Tampilkan</button> </form>

        <?php if ($tampilkan_laporan): ?>
            <hr>
            <h3>Laporan Penjualan (<?php echo date('d M Y', strtotime($tanggal_awal)); ?> - <?php echo date('d M Y', strtotime($tanggal_akhir)); ?>)</h3>
            
            <div class="menu" style="text-align: left;">
                <button onclick="window.print()" class="btn-laporan">Cetak Halaman</button>
                <a href="export_excel.php?start=<?php echo $tanggal_awal; ?>&end=<?php echo $tanggal_akhir; ?>" class="btn-tambah"> Export Excel</a>
            </div>
            
            <div style="width: 80%; margin: 20px auto;">
                <canvas id="salesChart"></canvas>
            </div>

            <h3>Rekap Penerimaan Harian</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($data_laporan)) {
                        foreach($data_laporan as $baris_data) {
                            echo "<tr>";
                            echo "<td>" . $baris_data['No'] . "</td>";
                            echo "<td>Rp" . number_format($baris_data['Total'], 0, ',', '.') . "</td>";
                            echo "<td>" . date('d M Y', strtotime($baris_data['Tanggal'])) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada data penjualan pada rentang tanggal ini.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            
            <br>
            
            <table class="total-summary-table">
                <thead>
                    <tr class="total-row">
                        <th>Jumlah Pelanggan</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="total-row">
                        <td><?php echo number_format($total_pelanggan, 0, ',', '.') . " Orang"; ?></td>
                        <td>Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
            
            <script>
                // --- 1. MEMBUAT ARRAY LABELS (TANGGAL) SECARA MANUAL DARI PHP ---
                const labels = [
                    <?php
                    $array_tanggal = [];
                    foreach ($data_laporan as $data_item) {
                        $tanggal_terformat = date('d M Y', strtotime($data_item['Tanggal']));
                        $array_tanggal[] = "'" . $tanggal_terformat . "'";
                    }
                    echo implode(", ", $array_tanggal);
                    ?>
                ];

                // --- 2. MEMBUAT ARRAY TOTALS SECARA MANUAL DARI PHP ---
                const totals = [
                    <?php
                    $array_total = [];
                    foreach ($data_laporan as $data_item) {
                        $array_total[] = $data_item['Total'];
                    }
                    echo implode(", ", $array_total);
                    ?>
                ];

                // --- 3. INISIALISASI CHART.JS ---
                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar', 
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: totals,
                            backgroundColor: 'rgba(0, 123, 255, 0.5)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total (Rp)'
                                },
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            </script>
        <?php endif; ?>
    </div>
</body>
</html>