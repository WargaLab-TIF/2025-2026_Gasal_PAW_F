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
    <h2>Data Master Supplier</h2>

    <a href="create.php" style="float:right; background-color: royalblue; color: white; padding: 5px 10px; text-decoration: none;">Tambah Data</a>
    <br><br>

    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <tr bgcolor="lightblue">
            <th>No</th>
            <th>Nama </th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
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
                <a href="edit.php?id=<?= $row['id']; ?>" style="background-color: deepskyblue; color: white; padding: 3px 6px; text-decoration: none;">Edit</a>
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus supplier ini?')" style="background-color: blue; color: white; padding: 3px 6px; text-decoration: none;">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
