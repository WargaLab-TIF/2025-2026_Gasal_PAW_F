<?php
require_once __DIR__ . "/../Core/koneksi.php";

$id = $_GET["id"] ?? "";

$transaksi = null;
if ($id != "") {
    $q = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '$id'");
    $transaksi = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./Assets/style.css">
</head>
<body>

<?php if (isset($_SESSION["notif"])): ?>
    <div class="alert" style="background:#f2f2f2; border-left:4px solid #333; padding:8px; margin-bottom:10px;">
        <?= is_array($_SESSION["notif"]) ? "<b>{$_SESSION["notif"]["judul"]}</b><br>{$_SESSION["notif"]["pesan"]}" : $_SESSION["notif"] ?>
    </div>
    <?php unset($_SESSION["notif"]); ?>
<?php endif; ?>




<h2><?= $id == "" ? "Tambah Transaksi Baru" : "" ?></h2>

<form action="./Proses/transaksi.php" method="POST" style="margin-bottom:20px;">
    <input type="hidden" name="submit_transaksi" value="true">

    <label>Pelanggan</label><br>
    <select name="pelanggan_id" required>
        <?php
        $p = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama ASC");
        while ($row = mysqli_fetch_assoc($p)):
        ?>
            <option value="<?= $row['id'] ?>" <?= ($transaksi && $transaksi['pelanggan_id'] == $row['id']) ? 'selected' : '' ?>>
                <?= $row['nama'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Waktu Transaksi</label><br>
    <input type="date" name="waktu_transaksi" value="<?= $transaksi['waktu_transaksi'] ?? date('Y-m-d'); ?>" required><br><br>

    <label>Keterangan</label><br>
    <textarea name="keterangan" required><?= $transaksi['keterangan'] ?? '' ?></textarea><br><br>

    <label>Total</label><br>
    <input type="number" name="total" value="<?= $transaksi['total'] ?? 0 ?>" readonly style="background:#eee;"><br><br>

    <button type="submit">Simpan</button>
</form>

<?php if ($id != ""): ?>
<hr><br>
<h3>Tambah Detail Transaksi</h3>

<form action="./Proses/transaksi.php" method="POST" style="margin-bottom:20px;">
    <input type="hidden" name="add_detail" value="true">
    
    <label>Pilih Transaksi</label><br>
    <select name="transaksi_id" required>
        <?php
        $trx = mysqli_query($conn, "SELECT id, waktu_transaksi, keterangan FROM transaksi ORDER BY id ASC");
        while ($t = mysqli_fetch_assoc($trx)):
        ?>
            <option value="<?= $t['id'] ?>">
                ID <?= $t['id'] ?> - <?= $t['waktu_transaksi'] ?> (<?= $t['keterangan'] ?>)
            </option>
        <?php endwhile; ?>
    </select><br><br>

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

<h3>Detail Transaksi Saat Ini</h3>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>ID Transaksi</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>total</th>
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

<br>
<a href="index.php"><button>Kembali ke Halaman Awal</button></a>

<?php endif; ?>
</body>
</html>