<?php
include "koneksi.php";

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];

$nama_file = "laporan_penjualan.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$nama_file");
header("Pragma: no-cache");
header("Expires: 0");

$sql_rekap = "SELECT 
                t.waktu_transaksi,
                SUM(td.qty * td.harga) AS total_penerimaan
              FROM transaksi t
              INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
              WHERE t.waktu_transaksi BETWEEN '$tgl1' AND '$tgl2'
              GROUP BY t.waktu_transaksi
              ORDER BY t.waktu_transaksi ASC";
$rekap = mysqli_query($conn, $sql_rekap);

$sql_total = "SELECT 
                COUNT(DISTINCT t.id) AS total_pelanggan,
                SUM(td.qty * td.harga) AS total_pendapatan
              FROM transaksi t
              INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
              WHERE t.waktu_transaksi BETWEEN '$tgl1' AND '$tgl2'";

$total = mysqli_fetch_assoc(mysqli_query($conn, $sql_total));
?>

<h3 style="text-align:center;">
    LAPORAN PENJUALAN Dari: <?= $tgl1 ?> s/d <?= $tgl2 ?>
</h3>

<table border="1" cellspacing="0" cellpadding="5">
    <tr style="background:lightgray;">
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    while ($r = mysqli_fetch_assoc($rekap)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$r['total_penerimaan']}</td>
                <td>{$r['waktu_transaksi']}</td>
              </tr>";
        $no++;
    }
    ?>
</table>

<br><br>

<table border="1" cellspacing="0" cellpadding="5">
    <tr style="background:lightgray;">
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total['total_pelanggan'] ?></td>
        <td><?= $total['total_pendapatan'] ?></td>
    </tr>
</table>