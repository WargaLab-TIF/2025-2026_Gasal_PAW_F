<?php
    include "koneksi.php";

    if (!isset($_GET['tgl_mulai']) || !isset($_GET['tgl_selesai'])) {
        die("Parameter tanggal tidak diberikan. Gunakan ?tgl_mulai=YYYY-MM-DD&tgl_selesai=YYYY-MM-DD");
    }

    $tgl_mulai = $_GET['tgl_mulai'];
    $tgl_selesai = $_GET['tgl_selesai'];

    $d1 = DateTime::createFromFormat('Y-m-d', $tgl_mulai);
    $d2 = DateTime::createFromFormat('Y-m-d', $tgl_selesai);
    if (!$d1 || !$d2) {
        die("Format tanggal tidak valid. Gunakan YYYY-MM-DD.");
    }
    if ($d1 > $d2) {
        die("Tanggal mulai tidak boleh setelah tanggal selesai.");
    }

    header("Content-type: application/vnd-ms-excel; charset=utf-8");
    $safe_start = mysqli_real_escape_string($conn, $d1->format('Y-m-d'));
    $safe_end   = mysqli_real_escape_string($conn, $d2->format('Y-m-d'));
    $filename = "Laporan_Penjualan_{$safe_start}_{$safe_end}.xls";
    header("Content-Disposition: attachment; filename=\"{$filename}\"");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Excel</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .header-main { background-color: #f2f2f2; } 
        .header-summary { background-color: #d1ecf1; color: #0c5460; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <h3 class="text-center">Rekap Laporan Penjualan</h3>
    <p class="text-center">Periode: <?= date('d M Y', strtotime($tgl_mulai)) ?> s/d <?= date('d M Y', strtotime($tgl_selesai)) ?></p>

    <table border="1">
        <thead>
            <tr>
                <th class="header-main" style="width: 50px;">No</th>
                <th class="header-main" style="width: 200px;">Total</th>
                <th class="header-main" style="width: 200px;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php 

            $sql = "SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) as total_harian 
                    FROM transaksi 
                    WHERE DATE(waktu_transaksi) BETWEEN '$safe_start' AND '$safe_end'
                    GROUP BY DATE(waktu_transaksi)
                    ORDER BY DATE(waktu_transaksi) ASC";
            $query = mysqli_query($conn, $sql);
            
            $no = 1;
            if ($query && mysqli_num_rows($query) > 0):
                while($row = mysqli_fetch_assoc($query)): 
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td>Rp <?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                    <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                </tr>
            <?php 
                endwhile;
            else:
            ?>
                <tr><td colspan="3" class="text-center">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br> <?php
        $sql_total = "SELECT COUNT(DISTINCT nama_pelanggan) as jum_pelanggan, COALESCE(SUM(total),0) as jum_pendapatan 
                      FROM transaksi 
                      WHERE DATE(waktu_transaksi) BETWEEN '$safe_start' AND '$safe_end'";
        $q_total = mysqli_query($conn, $sql_total);
        $d_total = mysqli_fetch_assoc($q_total);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th class="header-summary" style="width: 200px;">Jumlah Pelanggan</th>
                <th class="header-summary" style="width: 250px;">Jumlah Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size: 14px; font-weight: bold;">
                    <?= (int)($d_total['jum_pelanggan'] ?? 0) ?> Orang
                </td>
                <td style="font-size: 14px; font-weight: bold;">
                    Rp <?= number_format((float)($d_total['jum_pendapatan'] ?? 0), 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
