<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
</head>
<body>

<h2>Data Transaksi</h2>

<a href="report_transaksi.php">Lihat Laporan Penjualan</a>
&nbsp; | &nbsp;
<a href="tambah_transaksi.php">Tambah Transaksi</a>

<br><br>

<table border="1" cellpadding="7" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>ID Pelanggan</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['waktu_transaksi'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td><?= $row['total'] ?></td>
            <td><?= $row['pelanggan_id'] ?></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
