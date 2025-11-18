<?php
include 'koneksi.php';

$awal  = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

$form_hidden = isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir']);

if ($form_hidden) {
    $sql = "SELECT 
                DATE(transaksi.waktu_transaksi) AS tgl,
                SUM(transaksi_detail.harga * transaksi_detail.qty) AS total
            FROM transaksi
            JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
            WHERE DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'
            GROUP BY DATE(transaksi.waktu_transaksi)
            ORDER BY DATE(transaksi.waktu_transaksi) ASC";
    $result = mysqli_query($conn, $sql);

$labels = "";
$dataChart = "";
$tabelRekap = "";
$no = 1;
$totalPendapatanSemua = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $labels .= "'" . date('d M Y', strtotime($row['tgl'])) . "',";
    $dataChart .= $row['total'] . ",";
    $totalPendapatanSemua += $row['total'];

    $tabelRekap .= "
        <tr>
            <td>$no</td>
            <td>Rp".number_format($row['total'], 0, ',', '.') ."</td>
            <td>".date('d M Y', strtotime($row['tgl']))."</td>
        </tr>
    ";
    $no++;
}}


$sql2 = "SELECT COUNT(*) AS pelanggan FROM transaksi 
         WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'";
$r2 = mysqli_query($conn, $sql2);
$d2 = mysqli_fetch_assoc($r2);
$totalPelanggan = $d2['pelanggan'];

$sqlDetail = "SELECT transaksi.id, transaksi.waktu_transaksi,transaksi.pelanggan_id,
                SUM(transaksi_detail.harga * transaksi_detail.qty) AS total
              FROM transaksi
              JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
              WHERE DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'
              GROUP BY transaksi.id
              ORDER BY transaksi.waktu_transaksi ASC";
$resultDetail = mysqli_query($conn, $sqlDetail);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    @media print {
    .navbar, .btn, #form-filter {
        display: none;
    }
    .container {
        width: 100%;
        margin: 0;
        padding: 0;
        box-shadow: none; 
        border: none;
    }
}
    body {
        font-family: Arial, sans-serif;
        background: #f0f2f5;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background: #007bff;
        padding: 15px;
        color: white;
        display: flex;
        justify-content: space-between;
    }

    .navbar a {
        color: white;
        margin-left: 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .container {
        width: 95%;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
    }

    h3 {
        margin-top: 10px;
        border-left: 5px solid #007bff;
        padding-left: 10px;
    }

    .btn {
        padding: 8px 15px;
        background: green;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }
    .btn-back {
        background: #007bff;
    }

    .form-row {
        margin-top: 15px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    input[type="date"] {
        padding: 6px;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th {
        background: #e9f1ff;
        padding: 10px;
        border: 1px solid #ccc;
    }

    td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    .summary-box {
        margin-top: 20px;
        background: #f1f7ff;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #bcd4ff;
    }

</style>
<script>
function cetakLaporan() {
    window.print();
}
</script>
</head>
<body>

<div class="navbar">
    <div>Penjualan Store</div>
    <div>
        <a href="supplier.php">Supplier</a>
        <a href="barang.php">Barang</a>
        <a href="transaksi.php">Transaksi</a>
    </div>
</div>

<div class="container">

<h3>Rekap Laporan Penjualan</h3>

<a href="datamaster.php"><button class="btn btn-back">Kembali</button></a>

<?php if (!$form_hidden): ?>
    <div id="form-filter">
        <form method="GET" class="form-row">
            <input type="date" name="tgl_awal" value="<?= $awal ?>" required>
            <input type="date" name="tgl_akhir" value="<?= $akhir ?>" required>
            <button type="submit" class="btn">Tampilkan</button>
        </form>
    </div>
<?php endif; ?>
<?php if ($form_hidden): ?>
    <button onclick="cetakLaporan()" class="btn" style="background: #e74c3c;">Cetak</button>
    <a href="export_excel.php?tgl_awal=<?= $awal ?>&tgl_akhir=<?= $akhir ?>" target="_blank">
        <button class="btn" style="background: #27ae60;">Excel</button>
    </a>
<h3>Periode <?= date('d M Y', strtotime($awal)) ?> s/d <?= date('d M Y', strtotime($akhir)) ?></h3>

<canvas id="myChart"></canvas>

<script>
const labels = [<?= $labels ?>];
const dataValues = [<?= $dataChart ?>];

new Chart(document.getElementById("myChart"), {
    type: "bar",
    data: {
        labels: labels,
        datasets: [{
            label: "Total Pendapatan",
            data: dataValues,
            backgroundColor: "rgba(54,162,235,0.4)",
            borderColor: "rgba(54,162,235,1)",
            borderWidth: 1
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<h3>Rekap Pendapatan Harian</h3>
<table>
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>
    <?= $tabelRekap ?>
</table>

<div class="summary-box">
    <b>Jumlah Pelanggan:</b> <?= $totalPelanggan ?> Orang <br>
    <b>Total Pendapatan:</b> Rp<?= number_format($totalPendapatanSemua, 0, ',', '.') ?>
</div>

<h3>Detail Transaksi</h3>
<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Pelanggan</th>
        <th>Total</th>
    </tr>

    <?php 
    $no = 1;
    if (mysqli_num_rows($resultDetail) > 0) {
        while ($row = mysqli_fetch_assoc($resultDetail)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['waktu_transaksi'] ?></td>
        <td><?= $row['pelanggan_id'] ?></td>
        <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
    </tr>
    <?php 
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
    }
    ?>
</table>
<?php endif; ?>
</div>

</body>
</html>
