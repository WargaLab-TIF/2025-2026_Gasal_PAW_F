<?php 
include "../cek_login.php";
include "../koneksi.php";

$sql = mysqli_query($koneksi, "
    SELECT b.*, s.nama AS nama_supplier
    FROM barang b
    INNER JOIN supplier s ON b.supplier_id = s.id
    ORDER BY b.id ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>

<body style="font-family:Arial; background:#f3f3f3; padding:20px;">

<h2>Data Barang</h2>

<a href="tambah_barang.php"
   style="background:#BBCFFF; padding:8px 15px; color:purple; border-radius:5px; text-decoration:none;">
   Tambah Barang
</a>

<table border="1" cellpadding="8" cellspacing="0"
       style="width:100%; margin-top:20px; border-collapse:collapse; text-align:center;">
    
    <tr style="background:#e8dff5;">
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Supplier</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['kode_barang'] ?></td>
        <td><?= $row['nama_barang'] ?></td>
        <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
        <td><?= $row['stok'] ?></td>
        <td><?= $row['nama_supplier'] ?></td>
        <td>
            <a href="edit_barang.php?id=<?= $row['id'] ?>"
               style="background:#1a73e8; padding:5px 10px; color:white; border-radius:5px; text-decoration:none;">
               Edit
            </a>

            <a href="hapus_barang.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Yakin ingin menghapus?')"
               style="background:red; padding:5px 10px; color:white; border-radius:5px; text-decoration:none;">
               Hapus
            </a>
        </td>
    </tr>
    <?php } ?>

</table>
<br>
<a href="../index.php"
   style="background:#FEC8D8; padding:8px 15px; color:purple; border-radius:5px; text-decoration:none;">
   Kembali
</a>
</body>
</html>
