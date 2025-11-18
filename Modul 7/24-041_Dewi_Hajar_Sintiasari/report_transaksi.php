<?php
include 'conn.php';

$start_date = $_GET['start_date'] ?? '';
$end_date   = $_GET['end_date'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Penjualan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background: #f5f5f5;
        font-family: Arial;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background-color: #202020ff;
        color: white;
        padding: 0 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar a {
        color: white;
        text-decoration: none;
        margin-left: 15px;
    }

    .container {
        width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .judul {
        background: #1586ffff;
        padding: 10px;
        color: white;
        border-radius: 5px;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .btn {
        padding: 8px 14px;
        text-decoration: none;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        display: inline-block;
    }
    .btn-kembali { 
        background: #1586ffff; 
        color: white; 
    }
    .btn-tampilkan { 
        background: green; 
        color: white; 
    }
    .btn-yellow { 
        background: yellow; 
        color: black; 
    }

    .no-print { 
        display: inline-block; 
    }

    .filter-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    input[type="date"] {
        padding: 5px;
        border: 1px solid black;
        border-radius: 5px;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }
    table th {
        background: skyblue;
        padding: 10px;
    }
    table td {
        padding: 8px;
        border: 1px solid grey;
        text-align: center;
    }

    @media print {
        .no-print { display: none; }
        .navbar { display: none; }
    }

    .hidden { display:none; }
</style>

</head>
<body>

<div class="navbar">
    <h2>Penjualan XYZ</h2>
    <div>
        <a href="#">Supplier</a>
        <a href="#">Barang</a>
        <a href="index.php">Transaksi</a>
    </div>
</div>

<div class="container">
    <div class="judul">
        Rekap Laporan Penjualan 
        <?php if ($start_date && $end_date): ?>
            <?= date("d-m-Y", strtotime($start_date)) ?> sampai 
            <?= date("d-m-Y", strtotime($end_date)) ?>
        <?php endif; ?>
    </div>

    <a href="index.php" class="btn btn-kembali no-print" style="margin-bottom: 15px;">
    < Kembali </a>


    <form method="GET" class="filter-container no-print <?= ($start_date && $end_date) ? "hidden" : "" ?>" id="filterForm">
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button class="btn btn-tampilkan">Tampilkan</button>
    </form>

    <div id="reportContent" class="<?= ($start_date && $end_date) ? "" : "hidden" ?>">

        <?php if ($start_date && $end_date): ?>
            <div class="no-print" style="margin-bottom: 15px;">
                <button class="btn btn-yellow" onclick="window.print()">Cetak</button>
                <button class="btn btn-yellow" onclick="printExcel()">Excel</button>
            </div>
        <?php endif; ?>

        <?php
        $transaksi = [];
        $jumlah_pelanggan = 0;
        $total_pendapatan = 0;

        if ($start_date && $end_date) {
            $sql = "SELECT 
                        waktu_transaksi AS tanggal, 
                        SUM(total) AS total_tanggal,
                        COUNT(*) AS jumlah_transaksi
                    FROM transaksi
                    WHERE waktu_transaksi BETWEEN '$start_date' AND '$end_date'
                    GROUP BY waktu_transaksi
                    ORDER BY waktu_transaksi";


            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $transaksi[] = $row;
                $jumlah_pelanggan += $row["jumlah_transaksi"];
                $total_pendapatan += $row["total_tanggal"];
            }
        }

        $labels = array_column($transaksi, "tanggal");
        $data   = array_column($transaksi, "total_tanggal");
        ?>

        <canvas id="salesChart" height="100"></canvas>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($transaksi as $i => $row): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>Rp<?= number_format($row["total_tanggal"], 2, ',', '.') ?></td>
                    <td><?= $row["tanggal"] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <table style="margin-top: 20px;">
            <tr>
                <th>Jumlah Pelanggan</th>
                <th>Jumlah Pendapatan</th>
            </tr>
            <tr>
                <td><?= $jumlah_pelanggan ?> Orang</td>
                <td>Rp<?= number_format($total_pendapatan, 2, ',', '.') ?></td>
            </tr>
        </table>

    </div>
</div>

<script>

const ctx = document.getElementById("salesChart").getContext("2d");
new Chart(ctx, {
    type: "bar",
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: "Total",
            data: <?= json_encode($data) ?>,
            backgroundColor: "#6d6d6d44",
            borderColor: "#00000071",
            borderWidth: 1
        }]
    }
});

function printExcel() {
    window.location.href = 
        "excel_cetak.php?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>";
}
</script>

</body>
</html>