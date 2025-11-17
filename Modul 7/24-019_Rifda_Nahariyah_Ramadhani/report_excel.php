<?php
include "koneksi.php"; 

$filename = "Laporan_penjualan.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");

$tgl_awal_raw = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : null;
$tgl_akhir_raw = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : null;

if (empty($tgl_awal_raw) || empty($tgl_akhir_raw)) {
    $tgl_awal_sql = date('Y-m-d', strtotime('-7 days'));
    $tgl_akhir_sql = date('Y-m-d');
} else {
    $tgl_awal_sql = mysqli_real_escape_string($conn, $tgl_awal_raw);
    $tgl_akhir_sql = mysqli_real_escape_string($conn, $tgl_akhir_raw);
}

$tgl_awal_display = date('d-M-Y', strtotime($tgl_awal_sql));
$tgl_akhir_display = date('d-M-Y', strtotime($tgl_akhir_sql));

$sql_rekap = "SELECT DATE(waktu_transaksi) AS waktu_transaksi,
             COUNT(DISTINCT id) AS jumlah,
             SUM(total) AS total
             FROM transaksi
             WHERE waktu_transaksi BETWEEN '$tgl_awal_sql' AND '$tgl_akhir_sql'
             GROUP BY waktu_transaksi
             ORDER BY waktu_transaksi ASC"; 

$result_rekap = mysqli_query($conn, $sql_rekap);

$total_pelanggan_kumulatif = 0;
$total_pendapatan_kumulatif = 0;
$data_rekap_display = []; 

if ($result_rekap) {
    while($row = mysqli_fetch_assoc($result_rekap)) {
        $data_rekap_display[] = $row;
        $total_pendapatan_kumulatif += $row['total'];
    }
}

$sql_total_pelanggan = "SELECT COUNT(DISTINCT id) AS total
                        FROM transaksi
                        WHERE waktu_transaksi BETWEEN '$tgl_awal_sql' AND '$tgl_akhir_sql'";
$result_total_pelanggan = mysqli_query($conn, $sql_total_pelanggan);
if ($result_total_pelanggan) {
    $data_pelanggan = mysqli_fetch_assoc($result_total_pelanggan);
    $total_pelanggan_kumulatif = $data_pelanggan['total']; 
}

mysqli_close($conn);

?>
<table border="0">
    <tr>
        <td colspan="4" style="font-weight: bold; font-size: 16pt;">
            REKAP LAPORAN PENJUALAN
        </td>
    </tr>
    <tr>
        <td colspan="4">
            Periode: <?php echo $tgl_awal_display; ?> sampai <?php echo $tgl_akhir_display; ?>
        </td>
    </tr>
</table>

<br>

<table border="1">
    <thead>
        <tr style="font-weight: bold;">
            <th style="border: 1px solid black;">No</th>
            <th style="border: 1px solid black;">Total</th>
            <th style="border: 1px solid black;">Tanggal</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        $counter_display = 1;
        if (!empty($data_rekap_display)):
            foreach($data_rekap_display as $row):
                $tgl_display = date('d M Y', strtotime($row['waktu_transaksi'])); 
        ?>
        <tr>
            <td style="border: 1px solid black;"><?php echo $counter_display++; ?></td>
            <td style="border: 1px solid black;"><?php echo "Rp." . number_format($row['total'], 0, ',', '.'); ?></td>
            <td style="border: 1px solid black;"><?php echo $tgl_display; ?></td>

        </tr>
        <?php 
            endforeach;
        else:
        ?>
        <tr>
            <td colspan="4" style="text-align:center; border: 1px solid black;">Tidak ada data transaksi.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<br>
<table border="1">
    <thead>
        <tr style="font-weight: bold;">
            <th style="border: 1px solid black;">Jumlah Pelanggan</th>
            <th style="border: 1px solid black;">Jumlah Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid black;"><?php echo number_format($total_pelanggan_kumulatif) . " Pelanggan"; ?></td>
            <td style="border: 1px solid black;"><?php echo "Rp." . number_format($total_pendapatan_kumulatif, 0, '.', '.'); ?></td>
        </tr>
    </tbody>
</table>