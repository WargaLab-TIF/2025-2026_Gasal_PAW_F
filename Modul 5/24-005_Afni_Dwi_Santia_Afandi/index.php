<?php
include 'koneksi.php';

// ambil data supplier dari database
$query = mysqli_query($koneksi, "SELECT * FROM supplier");
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
</head>
<body>
    <h2 align="center">Data Master Supplier</h2>

    <a href="create.php" style="background-color: green; color: white; padding: 5px 10px; text-decoration: none;">Tambah Data</a>
    <br><br>

    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <tr bgcolor="#f2f2f2">
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        foreach ($data as $row) {
        ?>
        <tr>
            <td align="center"><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['telp']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td align="center">
                <a href="edit.php?id=<?= $row['id']; ?>" style="background-color: #8A2BE2; color: white; padding: 3px 6px; text-decoration: none;">Edit</a>
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" style="background-color: red; color: white; padding: 3px 6px; text-decoration: none;">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
