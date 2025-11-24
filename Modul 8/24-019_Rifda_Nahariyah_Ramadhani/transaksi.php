<?php
include "koneksi.php";
$sql = "SELECT t.id, t.waktu_transaksi, p.nama AS nama_pelanggan, u.username AS nama_user, t.keterangan, t.total
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        LEFT JOIN user u ON t.id = u.id_user 
        ORDER BY t.waktu_transaksi ASC, t.id ASC";

$result_query = mysqli_query($koneksi, $sql);

if (!$result_query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Transaksi Penjualan</title>
</head>
<body style="font-family: Arial, sans-serif;">

<table width="100%" bgcolor="black" cellpadding="10">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="dashboard.php" style="color:white; text-decoration:none;"><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>
<div align="center">
    <h1>DAFTAR TRANSAKSI PENJUALAN</h1>

    <table border="1" cellpadding="8" width="60%" style="margin-top: 10px;">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Pelanggan</th>
                <th width="15%">Kasir/User</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result_query) > 0) {
            while ($d = mysqli_fetch_assoc($result_query)) {
                $id_transaksi = htmlspecialchars($d['id']);
                $nama_pelanggan = !empty($d['nama_pelanggan']) ? htmlspecialchars($d['nama_pelanggan']) : 'Umum';
                echo "
                <tr style='text-align:center;'>
                    <td>{$id_transaksi}</td>
                    <td>" . date('d/m/Y', strtotime($d['waktu_transaksi'])) . "</td>
                    <td align='left'>{$nama_pelanggan}</td>
                    <td>" . htmlspecialchars($d['nama_user']) . "</td>
                    
                    <td>
                        <a href='detail_transaksi.php?id={$id_transaksi}' 
                           style='background-color: gold; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px; margin-right: 5px;'>
                           Detail
                        </a>
                        
                        <a href='hapus_transaksi.php?id={$id_transaksi}' 
                           style='background-color: red; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px;' 
                           onclick=\"return confirm('Yakin menghapus Transaksi ID {$id_transaksi}? Aksi ini tidak dapat dibatalkan!');\">
                           Hapus
                        </a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6' align='center'>Belum ada data transaksi.</td></tr>";
        }
        ?>
        </tbody>
    </table><br>
    <p>
        <a href="transaksi_baru.php" 
        style="padding: 10px 15px; background-color: limegreen; color: white; text-decoration: none; border-radius: 4px;">
            Buat Transaksi Baru
        </a>
    </p>
</div>
</body>
</html>