<?php
include '../koneksi.php'; 

session_start();
if (!isset($_SESSION['level'])) {
    header("location:../index.php");
    exit();
}

$start = isset($_GET['mulai']) ? mysqli_real_escape_string($koneksi, $_GET['mulai']) : date('Y-m-d');
$end   = isset($_GET['selesai']) ? mysqli_real_escape_string($koneksi, $_GET['selesai']) : date('Y-m-d');

$filename = "Laporan_Penjualan_" . $start . "_sd_" . $end . ".xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "SELECT t.*, p.nama_pelanggan 
        FROM transaksi t 
        LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
        WHERE DATE(t.waktu_transaksi) BETWEEN '$start' AND '$end' 
        ORDER BY t.waktu_transaksi ASC";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Error Database: " . mysqli_error($koneksi));
}
?>

<h3>Laporan Penjualan Toko</h3>
<p>Periode: <?= date('d-m-Y', strtotime($start)); ?> s/d <?= date('d-m-Y', strtotime($end)); ?></p>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr style="background-color:#007bff; color:white; font-weight:bold;">
            <th width="40" align="center">No</th>
            <th width="150" align="center">Tanggal Transaksi</th>
            <th width="200">Nama Pelanggan</th>
            <th width="250">Keterangan</th>
            <th width="150" align="right">Total (Rp)</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $no = 1;
    $totalOmset = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tgl_transaksi  = date('d-m-Y', strtotime($row['waktu_transaksi']));
            $nama_pelanggan = !empty($row['nama_pelanggan']) ? $row['nama_pelanggan'] : 'Umum / Non-Member';
            $keterangan     = !empty($row['keterangan']) ? $row['keterangan'] : '-';
            $total          = $row['total'];
    ?>
        <tr>
            <td align="center"><?= $no++; ?></td>
            <td align="center" style="mso-number-format:'\@';"><?= $tgl_transaksi; ?></td>
            <td><?= $nama_pelanggan; ?></td>
            <td><?= $keterangan; ?></td>
            <td align="right"><?= $total; ?></td>
        </tr>
    <?php
            $totalOmset += $total;
        }
    } else {
        echo "<tr><td colspan='5' align='center'>Tidak ada data transaksi pada periode ini.</td></tr>";
    }
    ?>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="background-color:#f0f0f0; border:none; height:10px;"></td>
        </tr>
        <tr style="background-color:#ffff00; font-weight:bold; font-size:14px;">
            <td colspan="4" align="center">TOTAL PENDAPATAN</td>
            <td align="right"><?= $totalOmset; ?></td>
        </tr>
    </tfoot>
</table>
