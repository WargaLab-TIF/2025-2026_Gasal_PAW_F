<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "store");

// Cek koneksi
if (!$koneksi) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

// --- Update otomatis kolom total di tabel transaksi (tanpa SUM SQL) ---

// Ambil semua data detail transaksi
$detail = mysqli_query($koneksi, "SELECT transaksi_id, harga FROM transaksi_detail");

// Siapkan array untuk menampung total per transaksi
$total_per_transaksi = [];

// Hitung total 
while ($d = mysqli_fetch_assoc($detail)) {
    $transaksi_id = $d['transaksi_id'];
    $harga = $d['harga'];

    // Jika transaksi_id belum ada di array, inisialisasi dulu
    if (!isset($total_per_transaksi[$transaksi_id])) {
        $total_per_transaksi[$transaksi_id] = 0;
    }

    // Tambahkan harga ke total transaksi tersebut
    $total_per_transaksi[$transaksi_id] += $harga;
}

// Update kolom total di tabel transaksi berdasarkan hasil hitung di atas
foreach ($total_per_transaksi as $id => $total) {
    mysqli_query($koneksi, "UPDATE transaksi SET total='$total' WHERE id='$id'");
}

// --- Ambil data untuk ditampilkan di tabel ---
$barang = mysqli_query($koneksi, "
    SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS supplier
    FROM barang b
    JOIN supplier s ON b.supplier_id = s.id
");

$transaksi = mysqli_query($koneksi, "
    SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan
    FROM transaksi t
    JOIN pelanggan p ON t.pelanggan_id = p.id
");

$transaksi_detail = mysqli_query($koneksi, "
    SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty
    FROM transaksi_detail td
    JOIN barang b ON td.barang_id = b.id
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengelolaan Master Detail</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 20px;">

<h2 style="text-align: center;">Pengelolaan Master Detail</h2>


<h3>Barang</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: center; margin-bottom: 20px;">
    <tr style="background-color: lightblue;">
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Nama Supplier</th>
        <th>Action</th>
    </tr>
    <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['kode_barang'] ?></td>
            <td><?= $b['nama_barang'] ?></td>
            <td><?= $b['harga'] ?></td>
            <td><?= $b['stok'] ?></td>
            <td><?= $b['supplier'] ?></td>
            <td>
                <a href="hapus_barang.php?id=<?= $b['id'] ?>"
                   onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                   style="color: white; background-color: navy; padding: 5px 10px; border-radius: 5px; text-decoration: none;">
                   Delete
                </a>
            </td>
        </tr>
    <?php } ?>
</table>


<h3>Transaksi</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: center; margin-bottom: 20px;">
    <tr style="background-color: lightblue;">
        <th>ID</th>
        <th>Waktu Transaksi</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Nama Pelanggan</th>
    </tr>
    <?php while ($t = mysqli_fetch_assoc($transaksi)) { ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= $t['waktu_transaksi'] ?></td>
            <td><?= $t['keterangan'] ?></td>
            <td><?= $t['total'] ?></td>
            <td><?= $t['pelanggan'] ?></td>
        </tr>
    <?php } ?>
</table>


<h3>Transaksi Detail</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; text-align: center; margin-bottom: 20px;">
    <tr style="background-color: lightblue;">
        <th>Transaksi ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
    </tr>
    <?php while ($d = mysqli_fetch_assoc($transaksi_detail)) { ?>
        <tr>
            <td><?= $d['transaksi_id'] ?></td>
            <td><?= $d['nama_barang'] ?></td>
            <td><?= $d['harga'] ?></td>
            <td><?= $d['qty'] ?></td>
        </tr>
    <?php } ?>
</table>


<div style="text-align: center;">
    <a href="tambah_transaksi.php" 
       style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-right: 10px;">
       Tambah Transaksi
    </a>

    <a href="transaksi_detail.php" 
       style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
       Tambah Transaksi Detail
    </a>
</div>

</body>
</html>
