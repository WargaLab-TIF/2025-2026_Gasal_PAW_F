<?php
include "koneksi.php";

// ambil filter tanggal dari URL, kalau tidak ada pakai 7 hari terakhir
$dari   = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime('-7 days'));
$sampai = isset($_GET['to'])   ? $_GET['to']   : date('Y-m-d');

// header agar browser mengunduh sebagai file Excel (HTML table dalam .xls)
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

// mulai bikin tabel utama
echo "<table border='1'>";
echo "<tr style='background:#cfe6ff'><th>No</th><th>Total Penerimaan (Rp)</th><th>Tanggal</th></tr>";

// query: jumlahkan total per tanggal dalam rentang yang dipilih
$sql = "SELECT t.waktu_transaksi AS tanggal, SUM(t.total) AS total_per_tanggal
        FROM transaksi t
        WHERE t.waktu_transaksi BETWEEN ? AND ?
        GROUP BY t.waktu_transaksi
        ORDER BY t.waktu_transaksi ASC";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ss", $dari, $sampai);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// tampilkan baris per-tanggal dan hitung total keseluruhan
$no = 1;
$total_semua = 0;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['total_per_tanggal'] . "</td>";
    echo "<td>" . date('d-m-Y', strtotime($row['tanggal'])) . "</td>";
    echo "</tr>";
    $total_semua += (int)$row['total_per_tanggal'];
}
echo "</table>";

// ---- ringkasan di bawah: jumlah pelanggan unik dan total pendapatan ----
$sql2 = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan
         FROM transaksi
         WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt2 = mysqli_prepare($koneksi, $sql2);
mysqli_stmt_bind_param($stmt2, "ss", $dari, $sampai);
mysqli_stmt_execute($stmt2);
$res2 = mysqli_stmt_get_result($stmt2);
$rc = mysqli_fetch_assoc($res2);
$jumlah_pelanggan = $rc ? $rc['jumlah_pelanggan'] : 0;

// tampilkan tabel ringkasan
echo "<br>";
echo "<table border='1'>";
echo "<tr style='background:#eaf6ff'><th>Jumlah Pelanggan</th><th>Jumlah Pendapatan (Rp)</th></tr>";
echo "<tr><td>" . $jumlah_pelanggan . "</td><td>" . $total_semua . "</td></tr>";
echo "</table>";

exit;
?>
