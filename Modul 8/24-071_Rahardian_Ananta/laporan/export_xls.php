<?php
    session_start();
    if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
        header("Location: ../login.php");
        exit();
    }
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "penjualan";
    $conn = new mysqli($host, $user, $password, $dbname);
    $awal = $_GET["awal"];
    $akhir = $_GET["akhir"];
    $namaFile = "Laporan_Penjualan_" . $awal . "_sd_" . $akhir . ".xls";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$namaFile");
    $statQuery = "
    SELECT
    COUNT(DISTINCT transaksi.pelanggan_id) AS jumlah_pelanggan,
    COALESCE(SUM(transaksi_detail.harga), 0) AS total_pendapatan
    FROM transaksi
    LEFT JOIN transaksi_detail
    ON transaksi.id = transaksi_detail.transaksi_id
    WHERE DATE(transaksi.waktu_transaksi) BETWEEN '$awal' AND '$akhir'
    ";
    $stat = mysqli_fetch_assoc(mysqli_query($conn, $statQuery));
    $filterQuery = "
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
    GROUP BY transaksi.id, transaksi.waktu_transaksi
    ";
    $result = mysqli_query($conn, $filterQuery);
?>
<!-- KITA GUNAKAN HTML TABLE AGAR HASIL EXCEL RAPI -->
<!DOCTYPE html>
<html>
    <head>
        <style>
            table  {
                border-collapse: collapse;
                width: 100%;
            }
            th, td  {
                border: 1px solid black;
                padding: 5px;
            }
            th  {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h3 style="text-align:center;">Rekap Laporan Penjualan</h3>
        <p style="text-align:center;">Periode: <?= $awal ?> s/d <?= $akhir ?></p>
        <!-- TABEL 1: RINCIAN -->
        <h4>1. Rincian Transaksi</h4>
        <table>
            <thead>
                <tr>
                    <th style="background-color: #333; color: white;">No</th>
                    <th style="background-color: #333; color: white;">ID Transaksi</th>
                    <th style="background-color: #333; color: white;">Tanggal</th>
                    <th style="background-color: #333; color: white;">Total Belanja</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td style="text-align:center;"><?= $no++ ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= date('d M Y', strtotime($row['waktu_transaksi'])) ?></td>
                    <td style="text-align:right;">
                        <!-- Format angka biasa tanpa 'Rp' agar bisa dijumlah di Excel -->
                        <?= $row['total_dihitung'] ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <!-- TABEL 2: RINGKASAN -->
        <h4>2. Ringkasan</h4>
        <table>
            <thead>
                <tr>
                    <th style="background-color: #f39c12;">Jumlah Pelanggan Unik</th>
                    <th style="background-color: #27ae60;">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center; font-size:14pt;"><?= $stat['jumlah_pelanggan'] ?></td>
                    <td style="text-align:right; font-size:14pt; font-weight:bold;">
                        <?= $stat['total_pendapatan'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>