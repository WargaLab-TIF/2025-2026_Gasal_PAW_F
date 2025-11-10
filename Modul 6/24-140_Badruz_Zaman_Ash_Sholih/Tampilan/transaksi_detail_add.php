<?php
require_once __DIR__ . "/../Core/koneksi.php";

$id = $_POST["transaksi_id"] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>

<h2>Tambah Detail Transaksi</h2>

<form action="" method="POST">
    <label>Pilih Transaksi</label><br>
    <select name="transaksi_id" required onchange="this.form.submit()">
        <option value="">-- Pilih Transaksi --</option>
        <?php
        $trx = mysqli_query($conn, "SELECT id, waktu_transaksi, keterangan FROM transaksi ORDER BY id ASC");
        while ($t = mysqli_fetch_assoc($trx)):
        ?>
            <option value="<?= $t['id'] ?>" <?= ($id == $t['id']) ? 'selected' : '' ?>>
                ID <?= $t['id'] ?> - <?= $t['waktu_transaksi'] ?> (<?= $t['keterangan'] ?>)
            </option>
        <?php endwhile; ?>
    </select>
</form>


<?php if ($id != ""): ?> 

<form action="./Proses/transaksi.php" method="POST">
    <input type="hidden" name="add_detail" value="true">
    <input type="hidden" name="transaksi_id" value="<?= $id ?>">

    <label>Pilih Barang</label><br>
    <select name="barang_id" required>
        <?php
        $barang = mysqli_query($conn, "SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang ASC");
        while ($b = mysqli_fetch_assoc($barang)):
        ?>
            <option value="<?= $b['id'] ?>">
                <?= $b['nama_barang'] ?> - Rp <?= number_format($b['harga']) ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Qty</label><br>
    <input type="number" name="qty" min="1" required><br><br>

    <button type="submit">Tambah</button>
</form>

<br>

<h3>Detail Transaksi Saat Ini</h3>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>ID Transaksi</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    <?php
    $d = mysqli_query($conn, "
        SELECT transaksi_detail.*, barang.nama_barang
        FROM transaksi_detail
        INNER JOIN barang ON transaksi_detail.barang_id = barang.id
        WHERE transaksi_detail.transaksi_id = '$id'
        ORDER BY barang.nama_barang ASC
    ");
    while ($row = mysqli_fetch_assoc($d)):
    ?>
    <tr>
        <td><?= $row['transaksi_id'] ?></td>
        <td><?= $row['nama_barang'] ?></td>
        <td><?= number_format($row['harga']) ?></td>
        <td><?= $row['qty'] ?></td>
        <td><?= number_format($row['harga'] * $row['qty']) ?></td>
        <td>
            <a href="./Proses/transaksi.php?delete_detail=true&id=<?= $id ?>&barang=<?= $row['barang_id'] ?>"
            onclick="return confirm('Yakin hapus item ini?');">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php endif; ?>

<br>
<a href="index.php"><button>Kembali</button></a>

</body>
</html>