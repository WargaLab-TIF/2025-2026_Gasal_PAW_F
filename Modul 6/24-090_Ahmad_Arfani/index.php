<?php
include 'koneksi.php';

$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$detail = mysqli_query($koneksi, "SELECT * FROM transaksi_detail");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pengelolaan Master Detail</h1>
    <h2>Barang</h2>
    <table border="1" cellpadding="5">
    <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Nama Supplier</th>
        <th>Action</th>
    </tr>
    <?php while ($b = mysqli_fetch_assoc($barang)) : ?>
    <tr>
        <td><?= $b['kode_barang']; ?></td>
        <td><?= $b['nama_barang']; ?></td>
        <td><?= number_format($b['harga'], 0, ',', '.'); ?></td>
        <td><?= $b['stok']; ?></td>
        <td><?= $b['supplier']; ?></td>
        <td>
        <form action="hapus_barang.php" method="get" style="margin:0;" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?');">
            <input type="hidden" name="id" value="<?= $b['id']; ?>">
            <button type="submit">Delete</button>
        </form>
        </td>

    </tr>
    <?php endwhile; ?>
    </table>
    <h2>Transaksi</h2>
    <table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Waktu Transaksi</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Nama Pelanggan</th>
    </tr>
    <?php while ($t = mysqli_fetch_assoc($transaksi)) : ?>
        <?php
        $pelanggan_id = $t['pelanggan_id'];
        $pelanggan_query = mysqli_query($koneksi, "SELECT nama FROM pelanggan WHERE id='$pelanggan_id'");
        $pelanggan = mysqli_fetch_assoc($pelanggan_query);
        ?>
        <tr>
        <td><?= $t['id']; ?></td>
        <td><?= $t['waktu_transaksi']; ?></td>
        <td><?= $t['keterangan']; ?></td>
        <td><?= number_format($t['total'], 0, ',', '.'); ?></td>
        <td><?= $pelanggan['nama']; ?></td>
        </tr>
    <?php endwhile; ?>
    </table>
    <h2>Transaksi Detail</h2>
    <table border="1" cellpadding="5">
    <tr>
        <th>Transaksi ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
    </tr>
    <?php while ($d = mysqli_fetch_assoc($detail)) : ?>
        <?php
        $barang_id = $d['barang_id'];
        $barang_query = mysqli_query($koneksi, "SELECT nama_barang FROM barang WHERE id='$barang_id'");
        $barang = mysqli_fetch_assoc($barang_query);
        ?>
        <tr>
        <td><?= $d['transaksi_id']; ?></td>
        <td><?= $barang['nama_barang']; ?></td>
        <td><?= number_format($d['harga'], 0, ',', '.'); ?></td>
        <td><?= $d['qty']; ?></td>
        </tr>
    <?php endwhile; ?>
    </table>
    <br>
    <br>
    <a href="tambah_transaksi.php">Tambah Transaksi</a>
    <a href="tambah_detail.php">Tambah Transaksi Detail</a>
</body>
</html>