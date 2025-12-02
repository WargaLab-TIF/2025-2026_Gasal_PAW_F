<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
    }
$tgl_a = $_GET['tgl_a'] ?? '';
$tgl_b = $_GET['tgl_b'] ?? '';
require '../include/conn.php';

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$sql = "SELECT waktu_transaksi,
               COUNT(*)             AS jumlah_transaksi,
               COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
               SUM(total)           AS total_harian
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$tgl_a' AND '$tgl_b'
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi";
$hasil = mysqli_query($koneksi, $sql);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
</head>
<body>
  <h3>Rekap Penjualan <?= $tgl_a ?> s.d. <?= $tgl_b ?></h3>

  <table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>
    <?php
    $no = 1;
    $pendapatan = 0;
    while ($rows = mysqli_fetch_assoc($hasil)) {
        echo "<tr>
                <td>$no</td>
                <td class='num'>{$rows['total_harian']}</td>
                <td>{$rows['waktu_transaksi']}</td>
              </tr>";
        $pendapatan += $rows['total_harian'];
        $no++;
    }
    ?>
    
  </table>
  <br>
  <table border="1" cellpadding="8">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?=mysqli_num_rows($hasil)?></td>
        <td><?= $pendapatan ?></td>
    </tr>
  </table>
</body>
</html>