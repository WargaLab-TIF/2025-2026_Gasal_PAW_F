<?php
include 'koneksi.php';
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan.xls");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="title-export">
        Rekap Laporan Penjualan <?php echo $tgl_awal; ?> sampai <?php echo $tgl_akhir; ?>
    </div>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th class="w-50">No</th>
                <th width="200">Total</th>
                <th width="150">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT date_transaksi, SUM(total) as total_harian 
                      FROM transaksi 
                      WHERE date_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'
                      GROUP BY date_transaksi
                      ORDER BY date_transaksi ASC";
            $result = mysqli_query($koneksi, $query);
            
            $no = 1;
            $grand_total = 0;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $grand_total += $row['total_harian'];
                    
                    $tanggal_formatted = date('d-M-y', strtotime($row['date_transaksi']));
                    
                    $total_formatted = "Rp" . number_format($row['total_harian'], 0, ',', '.');

                    echo "<tr>";
                    echo "<td class='text-center'>" . $no++ . "</td>";
                    echo "<td class='text-right'>" . $total_formatted . "</td>";
                    echo "<td class='text-center'>" . $tanggal_formatted . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>Data tidak ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>

    <?php
    $query_pelanggan = "SELECT COUNT(DISTINCT id_pelanggan) as jumlah_pelanggan 
                        FROM transaksi 
                        WHERE date_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
    $result_pelanggan = mysqli_query($koneksi, $query_pelanggan);
    $data_pelanggan = mysqli_fetch_assoc($result_pelanggan);
    $jml_pelanggan = $data_pelanggan['jumlah_pelanggan'];
    
    $grand_total_formatted = "Rp" . number_format($grand_total, 0, ',', '.');
    ?>

    <table border="1" class="w-half">
        <tr>
            <th style="text-align:left;">Jumlah Pelanggan</th>
            <th style="text-align:left;">Jumlah Pendapatan</th>
        </tr>
        <tr>
            <td><?php echo $jml_pelanggan; ?> Orang</td>
            <td class="text-right"><?php echo $grand_total_formatted; ?></td>
        </tr>
    </table>

</body>
</html>