<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!isset($_SESSION['user']) || !isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

$tgl_awal  = $_GET['tgl_awal'] ?? '';
$tgl_akhir = $_GET['tgl_akhir'] ?? '';

$where = "";
if ($tgl_awal != "" && $tgl_akhir != "") {
    $where = "WHERE transaksi.waktu_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
}

$q = mysqli_query($conn, "
    SELECT transaksi.*, pelanggan.nama 
    FROM transaksi
    INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    $where
    ORDER BY transaksi.waktu_transaksi ASC
");

$grafik = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    $where
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tgl ASC
");

$rekap = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    $where
    GROUP BY DATE(waktu_transaksi)
");

$summary = mysqli_query($conn, "
    SELECT 
        COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
        SUM(total) AS total_pendapatan
    FROM transaksi
    $where
");
$sum = mysqli_fetch_assoc($summary);
?>

<!DOCTYPE html>
<html>

<head>
    <title>laporan_penjualan</title>
    <style>
        * {
            font-family: verdana;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f9f9f9;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .tabel {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .tabel th,
        .tabel td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        .tabel th {
            background: #eee;
        }

        .btn-report,
        .btn-print {
            margin-left: 10px;
        }

        .btn-report,
        .btn-tampil,
        .btn-back,
        .btn-save,
        .btn-print,
        .btn-excel {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
        }

        button {
            cursor: pointer;
            border: none;
        }

        button a {
            text-decoration: none;
        }

        .btn-report {
            background: #007bff;
        }

        .btn-tampil {
            background: #4CAF50;
        }

        .btn-back {
            background: #0022ff;
        }

        .btn-save {
            background: #28a745;
        }

        .btn-print {
            background: #dea20b;
        }

        .btn-excel {
            background: #0E7F00;
        }

        .filter-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-box input[type="date"] {
            padding: 5px;
            border: 1px solid #777;
        }

        .form-box {
            background: white;
            padding: 20px;
            border-radius: 6px;
            width: 350px;
            margin: auto;
            border: 1px solid #ddd;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 95%;
            margin: 20px auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Laporan Penjualan</h2>

    <form method="GET" class="filter-box">
        <label>Dari:</label>
        <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>">

        <label>Sampai:</label>
        <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>">

        <button type="submit" class="btn-tampil">Tampilkan</button>
        <button type="button" class="btn-back" onclick="location.href='../transaksi/transaksi.php'">Kembali</button>
    </form>

    <button class="btn-print" onclick="window.print()"> Cetak </button>
    <button class="btn-excel" onclick="location.href='./laporan_transaksi_excel.php?&tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>'">Excel</button>


    <?php if ($tgl_awal != "" && $tgl_akhir != ""): ?>
        <div class="card">

            <canvas id="chartPenjualan"></canvas>

            <script>
                const labels = [
                    <?php while ($g = mysqli_fetch_assoc($grafik)) {
                        echo "'" . $g['tgl'] . "',";
                    } ?>
                ];
                const data = [
                    <?php
                    $grafik2 = mysqli_query($conn, "
                SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
                FROM transaksi
                $where
                GROUP BY DATE(waktu_transaksi)
            ");
                    while ($g2 = mysqli_fetch_assoc($grafik2)) {
                        echo $g2['total'] . ",";
                    }
                    ?>
                ];

                new Chart(document.getElementById('chartPenjualan'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Pendapatan',
                            data: data
                        }]
                    }
                });
            </script>

            <br>
            <table class="tabel">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>

                <?php
                $no = 1;
                while ($r = mysqli_fetch_assoc($rekap)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $r['tgl'] ?></td>
                        <td>Rp <?= number_format($r['total']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <br>
            <table class="tabel">
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Total Pendapatan</th>
                </tr>
                <tr>
                    <td><?= $sum['jumlah_pelanggan'] ?></td>
                    <td>Rp <?= number_format($sum['total_pendapatan']) ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
</body>
</html>