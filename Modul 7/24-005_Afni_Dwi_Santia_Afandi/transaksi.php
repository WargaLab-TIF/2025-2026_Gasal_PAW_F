<?php
$conn = mysqli_connect("localhost", "root", "", "store");
if (!$conn) {
    echo ("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT t.id, t.waktu_transaksi, p.nama AS nama_pelanggan, 
        t.keterangan, t.total
        FROM transaksi AS t
        INNER JOIN pelanggan AS p ON t.pelanggan_id = p.id
        ORDER BY t.id ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Transaksi</title>
</head>

<body style="font-family: Arial; background: #f3f3f3; margin:0; padding:0;">

<div style="width: 90%; margin: 30px auto;">

    <div style="text-align: left; margin-bottom: 20px;">
        <a href="report_transaksi3.php"
            style="background-color: #1c3385ff; color: white; padding: 10px 20px;
                   border-radius: 5px; text-decoration: none; margin-right: 10px;">
            Lihat Laporan Penjualan
        </a>

        <a href="tambah_transaksi.php"
            style="background-color: green; color: white; padding: 10px 20px;
                   border-radius: 5px; text-decoration: none;">
            Tambah Transaksi
        </a>
    </div>

    <!-- Tabel -->
    <table border="1" cellpadding="8" cellspacing="0"
           style="width:100%; border-collapse: collapse; text-align: center; margin-bottom: 20px;">

        <tr style="background-color: #e0e0e0;">
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['waktu_transaksi'] ?></td>
                <td><?= $row['nama_pelanggan'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                <td>
                    <a href="detail_transaksi.php"
                       style="color: white; background-color: #17a2b8; padding: 5px 10px;
                              border-radius: 5px; text-decoration: none; margin-right: 5px;">
                        Detail
                    </a>

                    <a href="hapus_transaksi.php"
                       onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                       style="color: white; background-color: red; padding: 5px 10px;
                              border-radius: 5px; text-decoration: none;">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
