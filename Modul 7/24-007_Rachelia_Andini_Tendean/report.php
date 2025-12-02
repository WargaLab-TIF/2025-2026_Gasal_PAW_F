<?php
include "koneksi.php";

// CEK DATE GET
$mulai   = isset($_GET['mulai'])   ? $_GET['mulai']   : null;
$selesai = isset($_GET['selesai']) ? $_GET['selesai'] : null;

// hanya tampil jika tanggal telah di-submit
$cekData = ($mulai && $selesai && $mulai != "" && $selesai != "");
?>
<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    font-family:Arial, Helvetica, sans-serif;
    background:#f2f4f7;
    margin:0;
}

.header{
    background:#2b2b2b;
    color:white;
    padding:14px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header .menu a{
    color:white;
    text-decoration:none;
    margin-left:25px;
}

.content-box{
    max-width:1200px;
    margin:0 auto;
    background:white;
    border:1px solid #ccc;
    border-top:none;
}

.subheader{
    background:#0086ff;
    padding:12px 18px;
    color:white;
    font-weight:bold;
    margin-top:10px; 
}

.inner-box{
    padding:20px;
    margin-top:10px;
}

.btn{
    padding:8px 14px;
    color:white;
    text-decoration:none;
    border-radius:4px;
    border:none;
    outline:none;
    cursor:pointer;
}

.btn-blue{ 
    background:#007bff; 
}

.btn-green{
    background:#28a745;
}

.btn-yellow{
    background: #FFC300;
    color: black;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th, .table td{
    padding:8px;
    border:1px solid #e2e8f0;
}

.right{
    text-align:right;
}

.small { font-size:13px; }

</style>

</head>
<body>

<div class="header">
    <div class="brand">Penjualan XYZ</div>
    <div class="menu">
        <a href="index.php">Transaksi</a>
        <a href="report.php">Laporan</a>
    </div>
</div>

<div class="content-box">
    <div class="subheader">Laporan Penjualan</div>

    <div class="inner-box">

<form method="GET" style="margin-bottom:20px;">
    <a class="btn btn-blue" href="index.php">&lt; Kembali</a><br><br>

    <input type="date" name="mulai" value="<?= $mulai ?>">

    <input type="date" name="selesai" value="<?= $selesai ?>">

    <button class="btn btn-green">Tampilkan</button>
</form>

<?php if (!$cekData) { ?>

    </div></div></body></html>
<?php exit; } ?>

<!-- TOMBOL CETAK DAN EXCEL -->
<a class="btn btn-yellow" href="cetak.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>">Cetak</a>
<a class="btn btn-yellow" href="excel.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>">Excel</a>

<br><br>

<?php
// AMBIL DATA
$rekap = mysqli_query($koneksi,"
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    GROUP BY tgl ORDER BY tgl ASC
");

$labels = [];
$nilai  = [];

while ($r = mysqli_fetch_assoc($rekap)) {
    $labels[] = date("d M Y", strtotime($r['tgl']));
    $nilai[]  = (int)$r['total'];
}

mysqli_data_seek($rekap, 0);

$totalan = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT COUNT(DISTINCT pelanggan_id) AS pelanggan,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
"));
?>

<canvas id="grafik" height="120"></canvas>

<script>
new Chart(document.getElementById('grafik'), {
    type: "bar",
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: "Total Penjualan",
            data: <?= json_encode($nilai) ?>,
            backgroundColor: "rgba(213, 217, 221, 0.7)"
        }]
    }
});
</script>

<!-- TABEL REKAP -->

<table class="table" style="border:1px solid #cfd8dc;">
    <tr style="background:#a8d4ff; font-weight:bold; text-align:center;">
        <th style="width:60px;">No</th>
        <th style="width:200px;">Total</th>
        <th style="width:200px;">Tanggal</th>
    </tr>

    <?php 
    $no = 1;
    mysqli_data_seek($rekap, 0);
    while($r=mysqli_fetch_assoc($rekap)){ 
        $tgl = date("d M Y", strtotime($r['tgl']));
    ?>
    <tr>
        <td style="text-align:center;"><?= $no++ ?></td>
        <td>Rp<?= number_format($r['total'],0,",",".") ?></td>
        <td><?= $tgl ?></td>
    </tr>
    <?php } ?>
</table>

<!-- TABEL TOTAL -->

<table style="width:460px; border-collapse:collapse; border:1px solid #cfd8dc;">
    <tr style="background:#a8d4ff; font-weight:bold;">
        <th style="padding:8px;">Jumlah Pelanggan</th>
        <th style="padding:8px;">Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td style="padding:8px;"><?= $totalan['pelanggan'] ?> Orang</td>
        <td style="padding:8px;">Rp<?= number_format($totalan['pendapatan'],0,",",".") ?></td>
    </tr>
</table>

    </div> 
</div>

</body>
</html>
