<?php
require 'auth.php';
require 'koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'list';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ============================
   TAMBAH ITEM KE KERANJANG
============================= */
if ($page == 'add_item') {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $q = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$barang_id'");
    $b = mysqli_fetch_assoc($q);

    $_SESSION['cart'][] = [
        'id' => $b['id'],
        'nama' => $b['nama_barang'],
        'harga' => $b['harga'],
        'qty' => $qty
    ];

    header("Location: transaksi.php?page=tambah");
    exit;
}

/* ============================
   HAPUS ITEM
============================= */
if ($page == 'hapus_item') {
    $key = $_GET['key'];
    unset($_SESSION['cart'][$key]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: transaksi.php?page=tambah");
    exit;
}

/* ============================
   SELESAIKAN TRANSAKSI
============================= */
if ($page == 'selesai') {
    $total = $_POST['total'];
    $waktu = date("Y-m-d");
    $ket   = "Transaksi Penjualan";

    mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                            VALUES ('$waktu', '$ket', '$total', NULL)");
    $transaksi_id = mysqli_insert_id($koneksi);

    foreach ($_SESSION['cart'] as $i) {
        mysqli_query($koneksi, "INSERT INTO transaksi_detail 
            (transaksi_id, barang_id, harga, qty)
            VALUES ('$transaksi_id','{$i['id']}','{$i['harga']}','{$i['qty']}')"
        );

        mysqli_query($koneksi, "UPDATE barang SET stok = stok - {$i['qty']} WHERE id='{$i['id']}'");
    }

    unset($_SESSION['cart']);
    header("Location: transaksi.php?page=berhasil");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Transaksi Penjualan</title>

<style>
    body {
        font-family: "Times New Roman", serif;
        margin: 20px;
    }

    h2, h3 {
        font-family: "Times New Roman", serif;
    }

    a, button, select, input {
        font-family: "Times New Roman", serif;
    }

    /* ========== TOMBOL HIJAU ========== */
    .btn-green {
        background: #2caa41;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        display: inline-block;
        border: none;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
    }
    .btn-green:hover {
        opacity: 0.85;
    }

    /* ========== STYLE TABEL ========== */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 18px;
        margin-top: 10px;
    }

    th {
        background: #2caa41;
        color: white;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 10px;
    }

    tr:nth-child(even) {
        background: #e8f8ec;
    }

    tr:nth-child(odd) {
        background: #ffffff;
    }

</style>

</head>
<body>

<?php include 'navbar.php'; ?>


<!-- =======================
      LIST TRANSAKSI
=========================== -->
<?php if ($page == 'list'): ?>

<h2>Riwayat Transaksi</h2>

<a href="transaksi.php?page=tambah" class="btn-green">+ Buat Transaksi Baru</a>

<table>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Keterangan</th>
    <th>Total</th>
</tr>

<?php
$no=1;
$q = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id DESC");
while ($r = mysqli_fetch_assoc($q)):
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $r['waktu_transaksi']; ?></td>
    <td><?= $r['keterangan']; ?></td>
    <td>Rp <?= number_format($r['total']); ?></td>
</tr>
<?php endwhile; ?>
</table>


<!-- =======================
      TAMBAH TRANSAKSI
=========================== -->
<?php elseif ($page == 'tambah'): ?>

<h2>Buat Transaksi</h2>

<?php $barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC"); ?>

<form method="post" action="transaksi.php?page=add_item">
    Barang:
    <select name="barang_id" required>
        <option value="">-- pilih --</option>
        <?php while ($b = mysqli_fetch_assoc($barang)): ?>
        <option value="<?= $b['id'] ?>">
            <?= $b['nama_barang'] ?> - Rp <?= $b['harga'] ?> (stok: <?= $b['stok'] ?>)
        </option>
        <?php endwhile; ?>
    </select>

    Qty: 
    <input type="number" name="qty" min="1" value="1" required>

    <button type="submit" class="btn-green">Tambah</button>
</form>

<h3>Keranjang</h3>

<table>
<tr>
    <th>Barang</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php
$total = 0;
foreach ($_SESSION['cart'] as $key => $i):
    $sub = $i['qty'] * $i['harga'];
    $total += $sub;
?>
<tr>
    <td><?= $i['nama']; ?></td>
    <td><?= $i['qty']; ?></td>
    <td>Rp <?= number_format($i['harga']); ?></td>
    <td>Rp <?= number_format($sub); ?></td>
    <td>
        <a class="btn-green" 
           href="transaksi.php?page=hapus_item&key=<?= $key ?>" 
           onclick="return confirm('Hapus item ini?')">
           Hapus
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h3>Total: Rp <?= number_format($total); ?></h3>

<form method="post" action="transaksi.php?page=selesai">
    <input type="hidden" name="total" value="<?= $total ?>">
    <button type="submit" class="btn-green">Selesaikan</button>
</form>


<!-- =======================
      BERHASIL
=========================== -->
<?php elseif ($page == 'berhasil'): ?>

<h2>Transaksi Berhasil!</h2>
<a href="transaksi.php" class="btn-green">Kembali ke Daftar Transaksi</a>

<?php endif; ?>

</body>
</html>
