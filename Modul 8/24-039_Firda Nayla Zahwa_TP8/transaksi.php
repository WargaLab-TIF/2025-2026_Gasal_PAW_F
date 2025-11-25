<?php 
include 'header.php';
require 'koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'list';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* --- TAMBAH ITEM KE KERANJANG --- */
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

/* --- HAPUS ITEM --- */
if ($page == 'hapus_item') {
    $key = $_GET['key'];
    unset($_SESSION['cart'][$key]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: transaksi.php?page=tambah");
    exit;
}

/* --- SELESAIKAN TRANSAKSI ---*/
if ($page == 'selesai') {

    $total = $_POST['total'];
    $waktu = date("Y-m-d");
    $ket   = "Transaksi Penjualan";

    mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                            VALUES ('$waktu', '$ket', '$total', NULL)");
    $transaksi_id = mysqli_insert_id($koneksi);

    foreach ($_SESSION['cart'] as $i) {
        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                                VALUES ('$transaksi_id','{$i['id']}','{$i['harga']}','{$i['qty']}')");
        mysqli_query($koneksi, "UPDATE barang SET stok = stok - {$i['qty']} WHERE id='{$i['id']}'");
    }

    unset($_SESSION['cart']);
    header("Location: transaksi.php?page=berhasil");
    exit;
}
?>

<style>
.container {
    width: 900px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

h2 {
    margin-top: 0;
    color: #003399;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th {
    background: #003399;
    color: white;
    padding: 10px;
}

td {
    padding: 8px;
    border: 1px solid #ddd;
}

.btn {
    background: #0066ff;
    padding: 8px 14px;
    color: white;
    border-radius: 5px;
    text-decoration: none;
}
.btn:hover {
    opacity: 0.85;
}
</style>

<div class="container">

<?php if ($page == 'list'): ?>

    <h2>Riwayat Transaksi</h2>
    <a href="transaksi.php?page=tambah" class="btn">+ Buat Transaksi</a>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Total</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id DESC");
        while ($r = mysqli_fetch_assoc($q)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $r['waktu_transaksi']; ?></td>
            <td><?= $r['keterangan']; ?></td>
            <td>Rp <?= number_format($r['total']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>


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

        <button class="btn">Tambah</button>
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
            <td><?= $i['nama'] ?></td>
            <td><?= $i['qty'] ?></td>
            <td>Rp <?= number_format($i['harga']) ?></td>
            <td>Rp <?= number_format($sub) ?></td>
            <td>
                <a class="btn" href="transaksi.php?page=hapus_item&key=<?= $key ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total: Rp <?= number_format($total) ?></h3>

    <form method="post" action="transaksi.php?page=selesai">
        <input type="hidden" name="total" value="<?= $total ?>">
        <button class="btn">Selesaikan</button>
    </form>


<?php elseif ($page == 'berhasil'): ?>

    <h2>Transaksi Berhasil!</h2>
    <a href="transaksi.php" class="btn">Kembali ke daftar transaksi</a>

<?php endif; ?>

</div>