<?php
include "koneksi.php";
$hasil = mysqli_query($koneksi, "SELECT * FROM supplier");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; }
        button { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
        .tambah { background: #28a745; color: white; margin-bottom: 15px; float: right; }
        .edit { background: #ff9f00; color: white; }
        .hapus { background: #dc3545; color: white; }
        button:hover { opacity: 0.8; }
    </style>
</head>
<body>

<h2>Data Master Supplier</h2>
<hr>
<form action="tambah.php" method="post" style="margin-bottom:10px;">
    <button class="tambah" type="submit">+ Tambah Data</button>
</form>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($hasil)) :
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['telp']) ?></td>
        <td><?= htmlspecialchars($row['alamat']) ?></td>
        <td>
            <form action="edit.php" method="get" style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button class="edit" type="submit">Edit</button>
            </form>
            <form action="hapus.php" method="post" style="display:inline;" onsubmit="return confirm('Anda yakin akan menghapus supplier ini?');">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button class="hapus" type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
