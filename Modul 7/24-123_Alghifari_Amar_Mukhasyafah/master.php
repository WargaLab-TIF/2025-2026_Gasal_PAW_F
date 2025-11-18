<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>Data Master Transaksi</h2>

<a class="button" href="tambah_transaksi.php">➕ Tambah Data</a>
<a class="button" href="report_transaksi.php">📊 Lihat Laporan Penjualan</a>
<br><br>

<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Pelanggan</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$sql = mysqli_query($conn,"
    SELECT t.*, p.nama AS nama_pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
    ORDER BY t.id DESC
");

while($row = mysqli_fetch_assoc($sql)){
?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['waktu_transaksi'] ?></td>
        <td><?= $row['keterangan'] ?></td>
        <td><?= number_format($row['total']) ?></td>
        <td><?= $row['nama_pelanggan'] ?></td>
        <td>
            <a class="button" href="edit_transaksi.php?id=<?= $row['id'] ?>">✏ Edit</a>
            <a class="button" style="background:#d9534f;" 
               href="hapus_transaksi.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</a>
        </td>
    </tr>
<?php
}
?>
</table>

</body>
</html>
