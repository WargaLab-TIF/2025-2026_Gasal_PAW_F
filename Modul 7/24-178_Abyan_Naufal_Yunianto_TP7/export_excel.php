<?php
include 'koneksi.php'; 
// Ambil parameter tanggal dari URL
$tanggal_awal = isset($_GET['start']) ? $koneksi->real_escape_string($_GET['start']) : date('Y-m-d');
$tanggal_akhir = isset($_GET['end']) ? $koneksi->real_escape_string($_GET['end']) : date('Y-m-d');

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan_" . $tanggal_awal . "_sampai_" . $tanggal_akhir . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

$query_rekap = "SELECT 
                    waktu_transaksi AS Tanggal, 
                    SUM(total) AS TotalHarian
                FROM 
                    transaksi
                WHERE 
                    waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                GROUP BY 
                    waktu_transaksi
                ORDER BY 
                    waktu_transaksi ASC";

$hasil_rekap = $koneksi->query($query_rekap);

$query_total = "SELECT 
                    COUNT(DISTINCT pelanggan_id) AS JumlahPelanggan,
                    SUM(total) AS TotalPendapatan
                FROM 
                    transaksi
                WHERE 
                    waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$hasil_total = $koneksi->query($query_total);
$total_data = $hasil_total->fetch_assoc();
$total_pelanggan = $total_data['JumlahPelanggan'] ?? 0;
$total_pendapatan = $total_data['TotalPendapatan'] ?? 0;
?>

<html>
<body>
    
    <center>
        <h2>REKAP LAPORAN PENJUALAN</h2>
        <h3>Periode: <?php echo date('d M Y', strtotime($tanggal_awal)); ?> sampai <?php echo date('d M Y', strtotime($tanggal_akhir)); ?></h3>
    </center>

    <br>

    <h4>Rekap Penerimaan Harian</h4>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Penjualan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nomor = 1;
            if ($hasil_rekap->num_rows > 0) {
                while($baris = $hasil_rekap->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $nomor++ . "</td>";
                    echo "<td>" . date('Y-m-d', strtotime($baris['Tanggal'])) . "</td>";
                    // Data tampillan sebagai angka agar dapat diolah di Excel
                    echo "<td>" . $baris['TotalHarian'] . "</td>"; 
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data penjualan pada periode ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>

    <h4>Total Kumulatif</h4>
    <table border="1">
        <thead>
            <tr>
                <th>Jumlah Pelanggan Unik</th>
                <th>Total Keseluruhan Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $total_pelanggan; ?> Orang</td>
                <td><?php echo $total_pendapatan; ?></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
<?php 
$koneksi->close();
?>