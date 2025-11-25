<?php
include 'koneksi.php';

// Ambil tanggal dari link
$tanggal_awal = $_GET['start_date'];
$tanggal_akhir = $_GET['end_date'];

// Header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Query data transaksi
$query = "SELECT waktu_transaksi, total 
          FROM transaksi 
          WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
          ORDER BY waktu_transaksi";

$result = mysqli_query($koneksi, $query);

// Query total pendapatan
$queryPendapatan = "SELECT SUM(total) AS pendapatan 
                    FROM transaksi 
                    WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

$resultPendapatan = mysqli_query($koneksi, $queryPendapatan);
$rowPendapatan = mysqli_fetch_assoc($resultPendapatan);

// Query jumlah pelanggan (jumlah transaksi)
$queryPelanggan = "SELECT COUNT(*) AS pelanggan 
                   FROM transaksi 
                   WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

$resultPelanggan = mysqli_query($koneksi, $queryPelanggan);
$rowPelanggan = mysqli_fetch_assoc($resultPelanggan);
?>

<h3>Laporan Penjualan <?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?></h3>

<table border="1">
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <tr>
            <td>" . $no++ . "</td>
            <td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
            <td>" . $row['waktu_transaksi'] . "</td>
        </tr>";
    }
    ?>
</table>

<br>

<table border="1">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $rowPelanggan['pelanggan'] ?></td>
        <td>Rp <?= number_format($rowPendapatan['pendapatan'], 0, ',', '.') ?></td>
    </tr>
</table>
