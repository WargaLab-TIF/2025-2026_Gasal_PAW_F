<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}
include 'koneksi.php';
$level = $_SESSION['level']; 

$data_laporan = [];
$total_pelanggan = 0;
$total_pendapatan = 0;
$tanggal_awal = date('Y-m-01');
$tanggal_akhir = date('Y-m-d');
$tampilkan_laporan = false;

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $tanggal_awal = $koneksi->real_escape_string($_GET['start_date']);
    $tanggal_akhir = $koneksi->real_escape_string($_GET['end_date']);
    $tampilkan_laporan = true;

    $query_rekap = "SELECT waktu_transaksi AS Tanggal, SUM(total) AS TotalHarian FROM transaksi 
                    WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
                    GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
    $hasil_rekap = $koneksi->query($query_rekap);
    if ($hasil_rekap->num_rows > 0) {
        $i = 1;
        while ($baris = $hasil_rekap->fetch_assoc()) {
            $data_laporan[] = ['No' => $i++, 'Total' => (int)$baris['TotalHarian'], 'Tanggal' => $baris['Tanggal']];
            $total_pendapatan += $baris['TotalHarian'];
        }
    }
    $query_pelanggan = "SELECT COUNT(DISTINCT pelanggan_id) AS JumlahPelanggan FROM transaksi 
                        WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    $hasil_pelanggan = $koneksi->query($query_pelanggan);
    $baris_pelanggan = $hasil_pelanggan->fetch_assoc();
    $total_pelanggan = $baris_pelanggan['JumlahPelanggan'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>Sistem Toko</h2>
        <a href="index.php">Dashboard</a>
        <?php if($level == 1) { ?>
            <div class="menu-label">Data Master</div>
            <a href="data_barang.php">Data Barang</a>
            <a href="data_supplier.php">Data Supplier</a>
            <a href="data_pelanggan.php">Data Pelanggan</a>
            <a href="data_user.php">Data User</a>
        <?php } ?>
        <div class="menu-label">Transaksi</div>
        <a href="transaksi.php">Data Transaksi</a>
        <a href="report_transaksi.php" style="background:#494e53; color:#fff;">Laporan</a>
        <br><a href="logout.php" class="btn-logout">Logout</a>
    </div>
    <div class="content">
        <div class="card">
            <h3>Filter Laporan Penjualan</h3>
            <form method="GET" class="filter-form">
                <label>Dari:</label>
                <input type="date" name="start_date" value="<?php echo htmlspecialchars($tanggal_awal); ?>" required>
                <label>Sampai:</label>
                <input type="date" name="end_date" value="<?php echo htmlspecialchars($tanggal_akhir); ?>" required>
                <button type="submit" class="btn-primary">Tampilkan</button>
            </form>
        </div>
        <?php if ($tampilkan_laporan): ?>
        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h3>Hasil Laporan</h3>
                <div>
                    <button onclick="window.print()" class="btn-laporan">Cetak PDF</button>
                    <a href="export_excel.php?start=<?= $tanggal_awal; ?>&end=<?= $tanggal_akhir; ?>" class="btn-tambah">Export Excel</a>
                </div>
            </div>
            <div style="width: 100%; height: 300px; margin-bottom: 20px;">
                <canvas id="salesChart"></canvas>
            </div>
            <table>
                <thead>
                    <tr><th>No</th><th>Tanggal</th><th>Total Penjualan</th></tr>
                </thead>
                <tbody>
                    <?php foreach($data_laporan as $row) { ?>
                        <tr>
                            <td><?= $row['No']; ?></td>
                            <td><?= date('d M Y', strtotime($row['Tanggal'])); ?></td>
                            <td>Rp <?= number_format($row['Total'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr style="background:#eee; font-weight:bold;">
                        <td colspan="2">Total Pendapatan</td>
                        <td>Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script>
            const ctx = document.getElementById('salesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?= implode(", ", array_map(function($d){ return "'".date('d M', strtotime($d['Tanggal']))."'"; }, $data_laporan)); ?>],
                    datasets: [{
                        label: 'Penjualan Harian',
                        data: [<?= implode(", ", array_column($data_laporan, 'Total')); ?>],
                        borderColor: 'blue', borderWidth: 2, fill: false
                    }]
                }
            });
        </script>
        <?php endif; ?>
    </div>
</body>
</html>