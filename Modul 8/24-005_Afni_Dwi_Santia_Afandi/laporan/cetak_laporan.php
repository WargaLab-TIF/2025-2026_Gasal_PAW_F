<?php
include "../cek_login.php";
include "../koneksi.php";

$start = isset($_GET['start']) ? $_GET['start'] : "";
$end   = isset($_GET['end']) ? $_GET['end'] : "";


$where = "";
if ($start != "" && $end != "") {
    $where = "WHERE t.waktu_transaksi BETWEEN '$start' AND '$end'";
}

// rekap
$sql = "SELECT t.waktu_transaksi AS tanggal, SUM(t.total) AS total
        FROM transaksi t
        $where
        GROUP BY t.waktu_transaksi
        ORDER BY t.waktu_transaksi ASC";

$rekap = mysqli_query($koneksi, $sql);


$label = [];
$data  = [];
$totalPendapatan = 0;
$jumlahHari = mysqli_num_rows($rekap);

// Loop data
mysqli_data_seek($rekap, 0);
while ($r = mysqli_fetch_assoc($rekap)) {
    $label[] = $r['tanggal'];
    $data[]  = $r['total'];
    $totalPendapatan += $r['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="font-family:Arial; padding:20px;">

<h2 style="text-align:center;">
    Rekap Laporan Penjualan 
    <?php 
        if ($start != "" && $end != "") echo "$start sampai $end";
        else echo "(Semua Data)";
    ?>
</h2>

<!-- grafik -->
<canvas id="chartCanvas" style="width:80%; max-width:700px; margin:auto; display:block;"></canvas>

<script>
var ctx = document.getElementById('chartCanvas').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($label) ?>,
        datasets: [{
            label: 'Total',
            data: <?= json_encode($data) ?>,
            backgroundColor: 'rgba(23,67,114,0.4)',
            borderColor: '#174372',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero:true }
        }
    }
});
</script>

<br><br>

<!-- Tabel Rekap -->
<table border="1" cellpadding="8" cellspacing="0" 
       style="width:90%; margin:auto; border-collapse:collapse; text-align:center;">
<tr style="background:#e0e0e0;">
    <th>No</th>
    <th>Total</th>
    <th>Tanggal</th>
</tr>

<?php 
$no = 1;
mysqli_data_seek($rekap, 0);
while ($row = mysqli_fetch_assoc($rekap)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td>Rp<?= number_format($row['total'],0,',','.') ?></td>
    <td><?= date("d M Y", strtotime($row['tanggal'])) ?></td>
</tr>
<?php } ?>

</table>

<br>

<!-- Tabel Total -->
<table border="1" cellpadding="8" cellspacing="0"
       style="width:50%; margin:auto; border-collapse:collapse; text-align:center;">
<tr style="background:#e0e0e0; font-weight:bold;">
    <td>Jumlah Pelanggan</td>
    <td>Jumlah Pendapatan</td>
</tr>
<tr>
    <td><?= $jumlahHari ?> Orang</td>
    <td>Rp<?= number_format($totalPendapatan,0,',','.') ?></td>
</tr>
</table>

<script>
window.print();
</script>

</body>
</html>
