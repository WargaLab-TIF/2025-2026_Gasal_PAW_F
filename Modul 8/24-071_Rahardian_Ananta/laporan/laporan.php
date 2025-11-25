<?php
    session_start();
    if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
        header("Location: ../login.php");
        exit();
    }
    $nama_user = isset($_SESSION["username"]) ? $_SESSION["username"] : "Admin";
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "penjualan";
    $conn = new mysqli($host, $user, $password, $dbname);
    $awal = isset($_POST["awal"]) ? $_POST["awal"] : date("Y-m-01");
    $akhir = isset($_POST["akhir"]) ? $_POST["akhir"] : date("Y-m-d");
    $dataTransaksi = [];
    $labels = [];
    $data = [];
    $stat = ["jumlah_pelanggan" => 0, "total_pendapatan" => 0];
    $showReport = false;
    if (isset($_POST["tampilkan"])) {
        $showReport = true;
        $awal = $_POST["awal"];
        $akhir = $_POST["akhir"];
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
        DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'
        GROUP BY transaksi.id, transaksi.waktu_transaksi";
        $result = mysqli_query($conn, $filter);
        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = date("d M Y", strtotime($row["waktu_transaksi"]));
            $data[] = (int) $row["total_dihitung"];
            $dataTransaksi[] = $row;
        }
        $statQuery = "
        SELECT
        COUNT(DISTINCT transaksi.pelanggan_id) AS jumlah_pelanggan,
        COALESCE(SUM(transaksi_detail.harga), 0) AS total_pendapatan
        FROM transaksi
        LEFT JOIN transaksi_detail
        ON transaksi.id = transaksi_detail.transaksi_id
        WHERE DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'";
        $statResult = mysqli_query($conn, $statQuery);
        $stat = mysqli_fetch_assoc($statResult);
    }
    $jsonLabels = json_encode($labels);
    $jsonData = json_encode($data);
    $no = 1;
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
                margin:0;
                font-family:sans-serif;
                background-color: #f4f7f6;
            }
            .navbar  {
                width:100%;
                background:#333;
                color:white;
                padding:10px;
                display:flex;
                align-items:center;
                box-sizing: border-box;
            }
            .navbar a  {
                color:white;
                margin-right:20px;
                text-decoration:none;
                font-size:18px;
            }
            .navbar a:hover  {
                text-decoration:underline;
            }
            .user-menu  {
                margin-left:auto;
                position:relative;
                cursor:pointer;
                color:white;
                font-size:18px;
            }
            .dropdown  {
                display:none;
                position:absolute;
                right:0;
                background:#444;
                padding:10px;
                border-radius:5px;
                z-index: 100;
            }
            .dropdown a  {
                display:block;
                color:white;
                text-decoration:none;
                padding:5px 10px;
            }
            .dropdown a:hover  {
                background:#555;
            }
            .user-menu:hover .dropdown  {
                display:block;
            }
            .container-laporan  {
                max-width:1000px;
                margin:30px auto;
                padding:30px;
                background:white;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .header-laporan  {
                background-color: #333;
                color: white;
                padding: 15px;
                font-size: 18px;
                font-weight: bold;
                margin: -30px -30px 20px -30px;
                border-radius: 8px 8px 0 0;
            }
            .filter-box  {
                background-color: #eee;
                padding: 15px;
                border-radius: 5px;
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
            }
            input[type="date"]  {
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .tombol  {
                padding:8px 15px;
                border-radius:5px;
                border:none;
                color:white;
                cursor:pointer;
                font-weight:bold;
                text-decoration:none;
                display:inline-block;
            }
            .tombol_hitam  {
                background:#333;
            }
            .tombol_hitam:hover  {
                background:#000;
            }
            .tombol_hijau  {
                background:#27ae60;
            }
            .tombol_hijau:hover  {
                background:#1e8449;
            }
            .tombol_kuning  {
                background:#f39c12;
            }
            .tombol_kuning:hover  {
                background:#d35400;
            }
            table  {
                border-collapse:collapse;
                width:100%;
                margin-top: 10px;
                border: 1px solid #ddd;
            }
            th, td  {
                padding:12px;
                border:1px solid #ddd;
                text-align:left;
            }
            th  {
                background:#333;
                color:white;
            }
            tr:nth-child(even)  {
                background-color: #f9f9f9;
            }
            @media print  {
                .navbar, .filter-box, .no-print  {
                    display: none;
                }
                .container-laporan  {
                    box-shadow: none;
                    border: none;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                }
                body  {
                    background: white;
                }
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="../index.php">Home</a>
            <?php if($_SESSION['level'] == "Admin"): ?>
            <a href="../datamaster/datamaster.php">Data Master</a>
            <?php endif; ?>
            <a href="../transaksi/transaksi.php">Transaksi</a>
            <a href="#">Laporan</a>
            <div class="user-menu">
                <?= $nama_user ?> ▼
                <div class="dropdown">
                    <a href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="container-laporan">
            <div class="header-laporan">
                Rekap Laporan Penjualan (<?= $awal ?> s/d <?= $akhir ?>)
            </div>
            <form method="POST" action="" class="filter-box">
                <label>Periode:</label>
                <input type="date" name="awal" value="<?= $awal ?>" required>
                <span>s/d</span>
                <input type="date" name="akhir" value="<?= $akhir ?>" required>
                <button type="submit" name="tampilkan" class="tombol tombol_hitam">Tampilkan</button>
            </form>
            <?php if ($showReport): ?>
            <div style="text-align: right; margin-bottom: 20px;" class="no-print">
                <a href="transaksi.php" class="tombol tombol_hitam" style="float:left;">&lt; Kembali</a>
                <button onclick="window.print()" class="tombol tombol_kuning">Cetak</button>
                <a href="export_xls.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="tombol tombol_hijau">Excel</a>
                <div style="clear:both;"></div>
            </div>
            <div style="width: 100%; height: 300px; margin-bottom: 30px;">
                <canvas id="myChart"></canvas>
            </div>
            <h3>1. Rincian Transaksi</h3>
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dataTransaksi)): ?>
                    <tr><td colspan="3" style="text-align:center;">Tidak ada data.</td></tr>
                    <?php else: ?>
                    <?php foreach ($dataTransaksi as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>Rp <?= number_format(
                                $row["total_dihitung"],
                                0,
                                ",",
                                ".",
                            ) ?></td>
                            <td><?= date(
                                    "d M Y",
                                    strtotime($row["waktu_transaksi"]),
                                ) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <br>
                    <h3>2. Ringkasan</h3>
                    <table style="width: 50%;">
                        <thead>
                            <tr>
                                <th>Jumlah Pelanggan</th>
                                <th>Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size: 1.2em;"><?= $stat[
                                        "jumlah_pelanggan"
                                    ] ?></td>
                                    <td style="font-size: 1.2em; font-weight:bold;">Rp <?= number_format(
                                            $stat["total_pendapatan"],
                                            0,
                                            ",",
                                            ".",
                                        ) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php else: ?>
                            <p style="text-align:center; padding:40px; color:#777;">Silakan pilih tanggal dan klik Tampilkan.</p>
                            <?php endif; ?>
                        </div>
                        <script>
                            <?php if ($showReport): ?>
                            const ctx = document.getElementById('myChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?= $jsonLabels ?>,
                                    datasets: [{
                                        label: 'Pendapatan',
                                        data: <?= $jsonData ?>,
                                        backgroundColor: 'rgba(51, 51, 51, 0.7)',
                                        borderColor: 'rgba(51, 51, 51, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: { y: { beginAtZero: true } }
                                }
                            });
                            <?php endif; ?>
                        </script>
                    </body>
                </html>