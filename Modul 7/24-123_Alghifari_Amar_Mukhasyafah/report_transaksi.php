<?php
include "koneksi.php";

$data = [];
$total_pendapatan = 0;
$total_transaksi = 0;

if(isset($_GET['tgl1'], $_GET['tgl2'])){
    $tgl1 = $_GET['tgl1'];
    $tgl2 = $_GET['tgl2'];

    $q = mysqli_query($conn,"
        SELECT tanggal, SUM(total) AS total
        FROM (
            SELECT 
                t.waktu_transaksi AS tanggal,
                COALESCE(td.harga * td.qty, t.total, 0) AS total
            FROM transaksi t
            LEFT JOIN transaksi_detail td ON td.transaksi_id = t.id
            WHERE t.waktu_transaksi BETWEEN '$tgl1' AND '$tgl2'
        ) x
        GROUP BY tanggal
        ORDER BY tanggal ASC
    ");

    while($r = mysqli_fetch_assoc($q)){
        $data[] = $r;
        $total_pendapatan += $r['total'];
    }

    $total_transaksi = count($data);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h2>LAPORAN PENJUALAN</h2>

<form method="GET">
    <label>Dari:</label>
    <input type="date" name="tgl1" required value="<?= $_GET['tgl1'] ?? '' ?>">
    <label>Sampai:</label>
    <input type="date" name="tgl2" required value="<?= $_GET['tgl2'] ?? '' ?>">
    <button type="submit">Filter</button>
</form>
<br>

<?php if(isset($_GET['tgl1'])): ?>

<?php if(!$data): ?>
    <p><b>Tidak ada data pada tanggal tersebut.</b></p>
<?php else: ?>

<h3>Grafik Penjualan</h3>
<canvas id="chart"></canvas>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const labels = <?= json_encode(array_column($data,'tanggal')) ?>;
    const values = <?= json_encode(array_column($data,'total')) ?>;

    new Chart(document.getElementById('chart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Total Penjualan',
                data: values
            }]
        }
    });
});
</script>

<h3>Rekap Penjualan</h3>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Total Pendapatan</th>
    </tr>
    <?php foreach($data as $d): ?>
    <tr>
        <td><?= $d['tanggal'] ?></td>
        <td>Rp <?= number_format($d['total']) ?></td>
    </tr>
    <?php endforeach ?>
</table>

<h3>Total Keseluruhan</h3>
<p>Total Transaksi: <?= $total_transaksi ?></p>
<p>Total Pendapatan: Rp <?= number_format($total_pendapatan) ?></p>

<button onclick="window.print()">Print</button>
<a class="button" href="export_excel.php?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>">Download Excel</a>

<?php endif; ?>
<?php endif; ?>

</body>
</html>
