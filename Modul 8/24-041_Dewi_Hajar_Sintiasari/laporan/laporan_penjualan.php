<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

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

    .container {
        width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .judul {
        background: #0274bd;
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
        font-weight: bold;
    }

    .btn-kembali { background: #0274bd; color: white; }
    .btn-cetak { background: orange; color: black; }
    .btn-excel { background: green; color: white; }

    .filter-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    input[type="date"] {
        padding: 8px;
        border: 1px solid black;
        border-radius: 5px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    table th {
        background: #0274bd;
        color: white;
        padding: 10px;
        text-align: center;
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

    .hidden { display: none; }
</style>

</head>
<body>

<div class="container">

    <div class="judul">
        Rekap Laporan Penjualan 
        <?php if ($start_date && $end_date): ?>
            <?= date("d-m-Y", strtotime($start_date)) ?> sampai <?= date("d-m-Y", strtotime($end_date)) ?>
        <?php endif; ?>
    </div>

    <a href="laporan_penjualan.php" class="btn btn-kembali no-print" style="margin-bottom: 15px;">
        < Kembali
    </a>

    <form method="GET" class="filter-container no-print <?= ($start_date && $end_date) ? "hidden" : "" ?>">
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button class="btn btn-kembali">Tampilkan</button>
    </form>

    <div class="<?= ($start_date && $end_date) ? "" : "hidden" ?>">

        <div class="no-print" style="margin-bottom: 15px;">
            <button class="btn btn-cetak" onclick="window.print()">Cetak</button>
            <button class="btn btn-excel" onclick="printExcel()">Export Excel</button>
        </div>

        <?php
        $transaksi = [];
        $jumlah_pelanggan = 0;
        $total_pendapatan = 0;

        if ($start_date && $end_date) {
            $sql = "
                SELECT 
                    DATE(waktu_transaksi) AS tanggal, 
                    SUM(total) AS total_tanggal,
                    COUNT(*) AS jumlah_transaksi
                FROM transaksi
                WHERE DATE(waktu_transaksi) BETWEEN '$start_date' AND '$end_date'
                GROUP BY DATE(waktu_transaksi)
                ORDER BY tanggal
            ";

            $result = mysqli_query($koneksi, $sql);
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
                    <th>Total Pendapatan</th>
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
                <th>Jumlah Transaksi</th>
                <th>Total Pendapatan</th>
            </tr>
            <tr>
                <td><?= $jumlah_pelanggan ?> Transaksi</td>
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
            label: "Total Pendapatan",
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