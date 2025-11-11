<?php
include "koneksi.php";

// Ambil data barang
$sql_barang = "SELECT * FROM barang";
$query_barang = mysqli_query($conn, $sql_barang);
$result_barang = mysqli_fetch_all($query_barang, MYSQLI_ASSOC);

// Ambil data transaksi (join dengan pelanggan)
$sql_transaksi = "SELECT t.*, p.nama AS nama_pelanggan 
                      FROM transaksi t 
                      JOIN pelanggan p ON t.pelanggan_id = p.id 
                      ORDER BY t.waktu_transaksi DESC";
$query_transaksi = mysqli_query($conn, $sql_transaksi);
$result_transaksi = mysqli_fetch_all($query_transaksi, MYSQLI_ASSOC);

// Ambil data transaksi detail (join dengan barang)
$sql_detail = "SELECT td.*, b.nama AS nama_barang 
                   FROM transaksi_detail td 
                   JOIN barang b ON td.barang_id = b.id 
                   ORDER BY td.transaksi_id";
$query_detail = mysqli_query($conn, $sql_detail);
$result_detail = mysqli_fetch_all($query_detail, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Master Detail</title>
    <link rel="stylesheet" href="css/indexStyle.css">
</head>

<body>

    <?php if (!empty($_GET['error'])): ?>
        <script>
            alert(<?= json_encode($_GET['error']) ?>);
        </script>
    <?php endif; ?>
    <h1>Data Master Toko</h1>

    <div class="header-container">
        <h2>Barang</h2>
        <button type="button" class="btn-tambah" onclick="window.location.href='tambah_barang.php'">Tambah Barang</button>
    </div>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Tindakan</th>
        </tr>
        <?php foreach ($result_barang as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                <td>
                    <button type="button" class="btn-hapus"
                        onclick="if (confirm('Yakin ingin menghapus barang <?= htmlspecialchars($row['nama']) ?>?')) { window.location.href='hapus_barang.php?id=<?= $row['id'] ?>'; }">
                        Hapus
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr style="margin: 30px 0; border: none;">

    <div class="header-container">
        <h2>Transaksi (Master)</h2>
        <button type="button" class="btn-tambah" onclick="window.location.href='tambah_transaksi.php'">Tambah Transaksi</button>
    </div>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Waktu Transaksi</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Nama Pelanggan</th>
        </tr>
        <?php foreach ($result_transaksi as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['waktu_transaksi'] ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr style="margin: 30px 0; border: none;">

    <div class="header-container">
        <h2>Transaksi Detail</h2>
        <button type="button" class="btn-tambah" onclick="window.location.href='tambah_detail.php'">Tambah Detail</button>
    </div>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Transaksi ID</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga</th>
        </tr>
        <?php foreach ($result_detail as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['transaksi_id'] ?></td>
                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td><?= $row['qty'] ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>