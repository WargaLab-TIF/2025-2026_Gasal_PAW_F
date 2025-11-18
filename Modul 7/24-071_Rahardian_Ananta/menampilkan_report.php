<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<style>
        /* Mengatur dasar halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0; 
            background-color: #f9f9f9; /* Warna abu-abu muda */
            padding: 20px; /* Kasih jarak dari pinggir browser */
            padding-left: 90px; /* Kasih jarak dari pinggir browser */
            padding-right: 90px; /* Kasih jarak dari pinggir browser */
        }

        /* [1] KOTAK PUTIH UTAMA */
        .container-laporan {
            background-color: #ffffff; /* Putih */
            border: 1px solid #e0e0e0; /* Garis abu-abu tipis */
            border-radius: 5px;
            padding-left: 35px;
            padding-right: 35px;
            overflow: hidden; 
        }

        /* [2] Header Biru (DI DALAM KOTAK) */
        .header-biru {
            background-color: #0d6efd; /* Warna biru */
            color: white;
            padding: 16px 20px;
            font-size: 18px;
            font-weight: bold;
            width:110%;
        }
        
        .biru{
            border: none;
            background-color: #0d6efd;
            color: white;
            margin-top: 15px;
            border-radius: 3px;
            padding:8px;
        }
        
        .kuning{
            border: none;
            background-color: gold;
            color: black;
            margin-top: 15px;
            border-radius: 3px;
            padding:8px;
        }
        
        @media print {
            .biru,.kuning {display: none;}
        }

    </style>
</head>
<body>
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);

$awal = "";
$akhir = "";
$result = null;
$stat = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $awal = $_POST["awal"];
    $akhir = $_POST["akhir"];

    // Query detail transaksi
    $filter = "
    SELECT
        transaksi.id,
        transaksi.waktu_transaksi,
        COALESCE(SUM(transaksi_detail.harga), 0) AS total_dihitung
    FROM 
        transaksi
    LEFT JOIN 
        transaksi_detail 
        ON transaksi.id = transaksi_detail.transaksi_id
    WHERE 
        transaksi.waktu_transaksi BETWEEN '$awal' AND '$akhir'
    GROUP BY transaksi.id, transaksi.waktu_transaksi;
    ";
    $result = mysqli_query($conn, $filter);

    // Query statistik kumulatif
    $statQuery = "
    SELECT 
        COUNT(DISTINCT transaksi.pelanggan_id) AS jumlah_pelanggan,
        COALESCE(SUM(transaksi_detail.harga), 0) AS total_pendapatan
    FROM transaksi
    LEFT JOIN transaksi_detail 
        ON transaksi.id = transaksi_detail.transaksi_id
    WHERE transaksi.waktu_transaksi BETWEEN '$awal' AND '$akhir';
    ";
    $stat = mysqli_fetch_assoc(mysqli_query($conn, $statQuery));
}

$no = 1;

$dataTransaksi = [];
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = date('d M Y', strtotime($row["waktu_transaksi"]));
    $data[]   = (int)$row["total_dihitung"];

    $dataTransaksi[] = $row;
}
$jsonLabels = json_encode($labels);
$jsonData = json_encode($data);

?>


<div class="container-laporan">
    
    <div class="header-biru"><td><?= "Rekap Laporan Penjualan " . $awal ." Sampai ". $akhir ?></td></div>
    
    <a href="index.php">
        <button class="biru"> < kembali</button>
    </a>
    
    <br>
    
    <button class="kuning" onclick="window.print()">
        Cetak
    </button>
    
    <a href="export_xls.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" style="color: green;">
        <button class="kuning" >Exel</button>
    </a>
    
    <div style="width: 70%; height:30%;">
        <canvas id="myChart"></canvas>
    </div>
    
    <br>
    
    
    
    <table border="1" cellpadding="5" style="width: 100%;">
        <tr>
            <th style="width:20%">No</th>
            <th style="width:40%">Total</th>
            <th style="width:40%">Tanggal</th>
        </tr>
        <?php foreach ($dataTransaksi as $row): ?>
        <tr>
            <td width="20"><?= $no++ ?></td>
            <td><?= "Rp" . number_format($row["total_dihitung"], 0, ',', '.') ?></td>
            <td><?= date('d M Y', strtotime($row["waktu_transaksi"])) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <br>
    
    <table border="1" cellpadding="5">
        <tr>
            <th>Jumlah Pelanggan</th>
            <th>Total Pendapatan</th>
        </tr>
        <tr>
            <td><?= $stat["jumlah_pelanggan"] ?></td>
            <td><?= $stat["total_pendapatan"] ?></td>
        </tr>
    </table>
</div>




<script>
    const labels = <?= $jsonLabels ?>;
    const dataValues = <?= $jsonData ?>;

    const data = {
        labels: labels,
        datasets: [{
            label: "Total",
            data: dataValues,
            backgroundColor: ["rgba(75, 192, 192, 0.5)"],
            borderColor: ["rgba(75, 192, 192, 1)"],
            borderWidth: 1
        }]
    };

    const options = {
        scales: { 
            y: {
                beginAtZero: true
            }
        }
    };

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
</script>


</body>
</html>