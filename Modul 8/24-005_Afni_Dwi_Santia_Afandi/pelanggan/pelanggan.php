<?php 
include "../cek_login.php";
include "../koneksi.php";

$sql = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
</head>

<body style="font-family:Arial; background:#f3f3f3; padding:20px;">

<h2>Data Pelanggan</h2>

<a href="tambah_pelanggan.php"
   style="background:#BBCFFF; padding:8px 15px; color:purple; border-radius:5px; text-decoration:none;">
   Tambah Pelanggan
</a>

<table border="1" cellpadding="8" cellspacing="0"
       style="width:100%; margin-top:20px; border-collapse:collapse; text-align:center;">
    
    <tr style="background:#e8dff5;">
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['telp'] ?></td>

        <td>
            <a href="edit_pelanggan.php?id=<?= $row['id'] ?>"
               style="background:#1a73e8; padding:5px 10px; color:white; border-radius:5px; text-decoration:none;">
               Edit
            </a>

            <a href="hapus_pelanggan.php?id=<?= $row['id'] ?>"
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
