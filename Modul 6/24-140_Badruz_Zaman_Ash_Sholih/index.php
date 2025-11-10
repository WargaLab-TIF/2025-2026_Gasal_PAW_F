<?php
session_start();
require_once "./Core/koneksi.php";

$page = $_GET['page'] ?? 'dashboard';

if ($page == 'detail') {
    require "./Tampilan/transaksi_detail.php";
    exit;
}

if ($page == 'detail_add') {
    require "./Tampilan/transaksi_detail_add.php";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>

<?php if (isset($_SESSION["notif"])): ?>
    <div class="alert" style="background:#f2f2f2; border-left:4px solid #333; padding:8px; margin-bottom:10px;">
        <?= is_array($_SESSION["notif"]) ? "<b>{$_SESSION["notif"]["judul"]}</b><br>{$_SESSION["notif"]["pesan"]}" : $_SESSION["notif"] ?>
    </div>
    <?php unset($_SESSION["notif"]); ?>
<?php endif; ?>

<h2>Pengelolaan Master Detail</h2>

<h3>Barang</h3>
<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Nama Supplier</th>
        <th>Aksi</th>
    </tr>

    <?php
    $q1 = mysqli_query($conn, "
        SELECT barang.id, barang.nama_barang, barang.harga, barang.stok, supplier.nama AS nama_supplier
        FROM barang
        INNER JOIN supplier ON barang.supplier_id = supplier.id
        ORDER BY barang.id ASC
    ");
    while ($b = mysqli_fetch_assoc($q1)):
    ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= $b['nama_barang'] ?></td>
        <td><?= number_format($b['harga']) ?></td>
        <td><?= $b['stok'] ?></td>
        <td><?= $b['nama_supplier'] ?></td>
        <td>
            <a href="Proses/barang.php?delete_barang=true&id=<?= $b['id'] ?>" class="delete-btn"
            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
            Hapus
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<br><br>

<div style="display:flex; gap:40px;">

<div style="width:50%;">
<h3>Transaksi</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Pelanggan</th>
        <th>Aksi</th>
    </tr>

    <?php
    $q2 = mysqli_query($conn, "
        SELECT transaksi.*, pelanggan.nama 
        FROM transaksi
        INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
        ORDER BY transaksi.id ASC
    ");
    while ($t = mysqli_fetch_assoc($q2)):
    ?>
    <tr>
        <td><?= $t['id'] ?></td>
        <td><?= $t['waktu_transaksi'] ?></td>
        <td><?= $t['keterangan'] ?></td>
        <td><?= number_format($t['total']) ?></td>
        <td><?= $t['nama'] ?></td>
        <td>
        <a href="Proses/transaksi.php?delete_transaksi=true&id=<?= $t['id'] ?>" class="delete-btn"
           onclick="return confirm('Hapus transaksi ini beserta semua detailnya?');">
           Hapus
        </a>
    </td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="index.php?page=detail"><button>Tambah Transaksi</button></a>
</div>


<div style="width:50%;">
<h3>Transaksi Detail </h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <th>Transaksi ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
    </tr>

    <?php
    $q3 = mysqli_query($conn, "
        SELECT transaksi_detail.*, barang.nama_barang
        FROM transaksi_detail
        INNER JOIN barang ON transaksi_detail.barang_id = barang.id
        ORDER BY transaksi_id ASC, barang_id ASC
    ");
    while ($d = mysqli_fetch_assoc($q3)):
    ?>
    <tr>
        <td><?= $d['transaksi_id'] ?></td>
        <td><?= $d['nama_barang'] ?></td>
        <td><?= number_format($d['harga']) ?></td>
        <td><?= $d['qty'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br>

<form class="form-detail" action="index.php" method="GET">
    <input type="hidden" name="page" value="detail_add">
    <button type="submit">Tambah Transaksi Detail</button>
</form>

</div>

</div>

</body>
</html>