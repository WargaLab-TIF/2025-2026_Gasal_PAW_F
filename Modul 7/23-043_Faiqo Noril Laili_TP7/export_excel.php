<?php
include 'koneksi.php';

$tanggal_awal = isset($_GET['tanggal_awal']) && $_GET['tanggal_awal'] ? $_GET['tanggal_awal'] : '2025-11-08';
$tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] ? $_GET['tanggal_akhir'] : '2025-11-14';

$sql_rekap = "SELECT waktu_transaksi, SUM(total) AS daily_total FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ? GROUP BY waktu_transaksi ORDER BY waktu_transaksi ASC";
$stmt_rekap = $koneksi->prepare($sql_rekap);
$stmt_rekap->bind_param("ss", $tanggal_awal, $tanggal_akhir);
$stmt_rekap->execute();
$result_rekap = $stmt_rekap->get_result();
$data_rekap = [];
while ($row = $result_rekap->fetch_assoc()) {
    $data_rekap[] = $row;
}
$stmt_rekap->close();

$sql_pendapatan = "SELECT SUM(total) AS total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt_pendapatan = $koneksi->prepare($sql_pendapatan);
$stmt_pendapatan->bind_param("ss", $tanggal_awal, $tanggal_akhir);
$stmt_pendapatan->execute();
$total_pendapatan = $stmt_pendapatan->get_result()->fetch_assoc()['total_pendapatan'] ?? 0;
$stmt_pendapatan->close();

$sql_pelanggan = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
$stmt_pelanggan = $koneksi->prepare($sql_pelanggan);
$stmt_pelanggan->bind_param("ss", $tanggal_awal, $tanggal_akhir);
$stmt_pelanggan->execute();
$jumlah_pelanggan = $stmt_pelanggan->get_result()->fetch_assoc()['jumlah_pelanggan'] ?? 0;
$stmt_pelanggan->close();


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Laporan Penjualan</title>
    <meta charset="utf-8">
</head>

<body>

    <table border="1">
        <tr>
            <td colspan="3" style="font-weight: bold;">
                Rekap Laporan Penjualan <?php echo date('Y-m-d', strtotime($tanggal_awal)); ?> sampai <?php echo date('Y-m-d', strtotime($tanggal_akhir)); ?>
            </td>
        </tr>
    </table>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th style="font-weight: bold; background-color: #DDEBF7;">No</th>
                <th style="font-weight: bold; background-color: #DDEBF7;">Total</th>
                <th style="font-weight: bold; background-color: #DDEBF7;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_rekap as $row):
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td data-type="number"><?php echo $row['daily_total']; ?></td>
                    <td><?php echo date('d-M-y', strtotime($row['waktu_transaksi'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>

    <table border="1">
        <thead>
            <tr>
                <th style="font-weight: bold; background-color: #ADD8E6;">Jumlah Pelanggan</th>
                <th style="font-weight: bold; background-color: #ADD8E6;">Jumlah Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $jumlah_pelanggan; ?> Orang</td>
                <td data-type="number"><?php echo $total_pendapatan; ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>