<?php
require_once "./Core/koneksi.php";

$tgl_awal  = $_GET['tgl_awal'] ?? '';
$tgl_akhir = $_GET['tgl_akhir'] ?? '';

$where = "";
if ($tgl_awal != "" && $tgl_akhir != "") {
    $where = "WHERE transaksi.waktu_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
}

$q = mysqli_query($conn, "
    SELECT transaksi.*, pelanggan.nama 
    FROM transaksi
    INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    $where
    ORDER BY transaksi.waktu_transaksi ASC
");

$grafik = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    $where
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tgl ASC
");

$rekap = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    $where
    GROUP BY DATE(waktu_transaksi)
");

$summary = mysqli_query($conn, "
    SELECT 
        COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
        SUM(total) AS total_pendapatan
    FROM transaksi
    $where
");
$sum = mysqli_fetch_assoc($summary);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="assets/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="nav-top">
        <button class="nav-btn" onclick="alert('Hanya Tampilan')">Supplier</button>
        <button class="nav-btn" onclick="alert('Hanya Tampilan')">Barang</button>
        <button class="nav-btn" onclick="location.href='transaksi.php'">Transaksi</button>
    </div>

    <h2>Laporan Penjualan</h2>

    <form method="GET" class="filter-box">
        <label>Dari:</label>
        <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>">

        <label>Sampai:</label>
        <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>">

        <button type="submit" class="btn-tampil">Tampilkan</button>
        <button type="button" class="btn-back" onclick="location.href='transaksi.php'">Kembali</button>
    </form>

    <button class="btn-print"onclick="window.print()"> Cetak </button>
    <button class="btn-excel" onclick="location.href='report_transaksi_excel.php?&tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>'">Excel</button>


    <?php if ($tgl_awal != "" && $tgl_akhir != ""): ?>
        <div class="card">

            <canvas id="chartPenjualan"></canvas>

            <script>
                const labels = [
                    <?php while ($g = mysqli_fetch_assoc($grafik)) {
                        echo "'" . $g['tgl'] . "',";
                    } ?>
                ];
                const data = [
                    <?php
                    $grafik2 = mysqli_query($conn, "
                SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
                FROM transaksi
                $where
                GROUP BY DATE(waktu_transaksi)
            ");
                    while ($g2 = mysqli_fetch_assoc($grafik2)) {
                        echo $g2['total'] . ",";
                    }
                    ?>
                ];

                new Chart(document.getElementById('chartPenjualan'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Pendapatan',
                            data: data
                        }]
                    }
                });
            </script>
            
            <br>
            <table class="tabel">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>

                <?php
                $no = 1;
                while ($r = mysqli_fetch_assoc($rekap)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $r['tgl'] ?></td>
                        <td>Rp <?= number_format($r['total']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <br>
            <table class="tabel">
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Total Pendapatan</th>
                </tr>
                <tr>
                    <td><?= $sum['jumlah_pelanggan'] ?></td>
                    <td>Rp <?= number_format($sum['total_pendapatan']) ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
</body>
</html>