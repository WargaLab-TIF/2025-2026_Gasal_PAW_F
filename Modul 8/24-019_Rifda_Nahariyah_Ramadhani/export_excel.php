<?php
include "koneksi.php";

$tgl_awal = isset($_GET['tgl_awal']) ? mysqli_real_escape_string($koneksi, $_GET['tgl_awal']) : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? mysqli_real_escape_string($koneksi, $_GET['tgl_akhir']) : date('Y-m-d');

$sql = "SELECT t.id AS ID, 
            DATE_FORMAT(t.waktu_transaksi, '%Y-%m-%d') AS Waktu_Transaksi, 
            IFNULL(p.nama, 'Umum') AS Pelanggan, u.username AS Kasir_User, t.total AS Total
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        LEFT JOIN user u ON t.id = u.id_user 
        WHERE DATE(t.waktu_transaksi) BETWEEN '$tgl_awal' AND '$tgl_akhir'
        ORDER BY t.waktu_transaksi ASC";

$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
$filename = "Laporan_Transaksi.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

$output = "<h2>Laporan Transaksi Penjualan</h2>";
$output .= "Periode: " . date('d/m/Y', strtotime($tgl_awal)) . " s/d " . date('d/m/Y', strtotime($tgl_akhir)) . "<br><br>";
$output .= "<table border='1'>";

$output .= "<tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Pelanggan</th>
                <th>Kasir/User</th>
                <th>Total (Rp)</th>
            </tr>";

$grand_total = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $total_numerik = (float)$row['Total'];
        $grand_total += $total_numerik;
        
        $output .= "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['Waktu_Transaksi']}</td>
                        <td>" . htmlspecialchars($row['Pelanggan']) . "</td>
                        <td>" . htmlspecialchars($row['Kasir_User']) . "</td>
                        <td align='right'>Rp." . number_format($total_numerik, 0, '', '.') . "</td> 
                    </tr>";
    }
} else {
    $output .= "<tr><td colspan='5' align='center'>Tidak ada data untuk diekspor pada periode ini.</td></tr>";
}

$output .= "<tr>
                <td colspan='4' align='right'><b>GRAND TOTAL PENDAPATAN</b></td>
                <td align='right'><b>Rp." . number_format($grand_total, 0, '', '.') . "</b></td>
            </tr>";

$output .= "</table>";

echo $output;
exit;
?>