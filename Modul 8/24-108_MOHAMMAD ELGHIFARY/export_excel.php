<?php
require_once "conn.php";

if (isset($_GET['tampilkan']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
    
    $data_rekap = [];
    $total_pendapatan = 0;
    $total_pelanggan = 0;
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $start_datetime = $start_date . ' 00:00:00';
    $end_datetime = $end_date . ' 23:59:59';

    $sql_rekap = "SELECT 
                    DATE_FORMAT(waktu_transaksi, '%d %b %Y') AS tanggal_formatted,
                    DATE(waktu_transaksi) AS tanggal, 
                    SUM(total) AS total_harian
                  FROM 
                    transaksi
                  WHERE 
                    waktu_transaksi BETWEEN ? AND ?
                  GROUP BY 
                    DATE(waktu_transaksi)
                  ORDER BY 
                    tanggal ASC";
    
    $stmt_rekap = mysqli_prepare($conn, $sql_rekap);
    mysqli_stmt_bind_param($stmt_rekap, 'ss', $start_datetime, $end_datetime);
    mysqli_stmt_execute($stmt_rekap);
    $result_rekap = mysqli_stmt_get_result($stmt_rekap);
    while ($row = mysqli_fetch_assoc($result_rekap)) {
        $data_rekap[] = $row;
    }

    $sql_total = "SELECT
                    COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
                    SUM(total) AS jumlah_pendapatan
                  FROM
                    transaksi
                  WHERE
                    waktu_transaksi BETWEEN ? AND ?";
    $stmt_total = mysqli_prepare($conn, $sql_total);
    mysqli_stmt_bind_param($stmt_total, 'ss', $start_datetime, $end_datetime);
    mysqli_stmt_execute($stmt_total);
    $result_total = mysqli_stmt_get_result($stmt_total);
    $row_total = mysqli_fetch_assoc($result_total);
    
    $total_pelanggan = $row_total['jumlah_pelanggan'] ?? 0;
    $total_pendapatan = $row_total['jumlah_pendapatan'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        td { text-align: right; }
    </style>
</head>
<body>
    <h3>Rekap Laporan Penjualan <?php echo $start_date; ?> sampai <?php echo $end_date; ?></h3>

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
            $no = 1;
            foreach ($data_rekap as $rekap): ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo "Rp " . number_format($rekap['total_harian'], 0, ',', '.'); ?></td>
                <td><?php echo $rekap['tanggal_formatted']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <br>
    
    <table style="width: 50%;">
        <thead>
            <tr>
                <th>Jumlah Pelanggan</th>
                <th>Jumlah Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;"><?php echo $total_pelanggan; ?> Orang</td>
                <td><?php echo "Rp " . number_format($total_pendapatan, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
<?php
} else {
    echo "Parameter tidak lengkap.";
}
?>