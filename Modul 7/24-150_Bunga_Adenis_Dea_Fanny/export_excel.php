<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan.xls");

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

// Ambil data transaksi lengkap 
$data = mysqli_query($conn, "
    SELECT waktu_transaksi, total, keterangan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
    ORDER BY waktu_transaksi ASC
");

// Hitung total pendapatan
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
"))['total'] ?? 0;

// Hitung jumlah pelanggan
$totalPelanggan = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$dari' AND '$sampai'
"))['total'] ?? 0;
?>

<!-- Judul Laporan -->
<h3>Rekap Laporan Penjualan <?= $dari ?> sampai <?= $sampai ?></h3>

<br>

<!-- Tabel Rekap -->
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    mysqli_data_seek($data, 0);
    while ($row = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['keterangan'] ?></td>
        <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
        <td><?= date('d-M-Y', strtotime($row['waktu_transaksi'])) ?></td>
    </tr>
    <?php } ?>
</table>

<br><br>

<!-- Tabel Total -->
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $totalPelanggan ?> Orang</td>
        <td>Rp<?= number_format($totalPendapatan, 0, ',', '.') ?></td>
    </tr>
</table>
