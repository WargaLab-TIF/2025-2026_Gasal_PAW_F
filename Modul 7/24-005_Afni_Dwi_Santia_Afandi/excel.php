<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$conn = mysqli_connect("localhost", "root", "", "store");

// Ambil tanggal 
$start = isset($_GET['start']) ? $_GET['start'] : "";
$end   = isset($_GET['end']) ? $_GET['end'] : "";


$where = "";
if ($start != "" && $end != "") {
    $where = "WHERE t.waktu_transaksi BETWEEN '$start' AND '$end'";
}

// Query data
$sql = "SELECT t.waktu_transaksi AS tanggal, SUM(t.total) AS total
        FROM transaksi t
        $where
        GROUP BY t.waktu_transaksi
        ORDER BY t.waktu_transaksi ASC";

$rekap = mysqli_query($conn, $sql);

// Hitung total pendapatan & pelanggan
$totalPendapatan = 0;
$jumlahPelanggan = mysqli_num_rows($rekap);

// Format judul Excel
if ($start != "" && $end != "") {
    $judul = "Rekap Laporan Penjualan $start sampai $end";
} else {
    $judul = "Rekap Laporan Penjualan";
}
?>

<h2><?= $judul ?></h2>

<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
    <tr style="background:#e0e0e0; font-weight:bold;">
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

<?php 
$no = 1;
mysqli_data_seek($rekap, 0);

while ($r = mysqli_fetch_assoc($rekap)) { 
    $totalPendapatan += $r['total'];
?>
    <tr>
        <td><?= $no++ ?></td>
        <td>Rp<?= number_format($r['total'],0,',','.') ?></td>
        <td><?= date("d-M-Y", strtotime($r['tanggal'])) ?></td>
    </tr>
<?php } ?>

</table>

<br>

<table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
    <tr style="background:#e0e0e0; font-weight:bold;">
        <td>Jumlah Pelanggan</td>
        <td>Jumlah Pendapatan</td>
    </tr>
    <tr>
        <td><?= $jumlahPelanggan ?> Orang</td>
        <td>Rp<?= number_format($totalPendapatan,0,',','.') ?></td>
    </tr>
</table>
