<?php

    include "koneksi.php";

    $sql = "SELECT * FROM supplier";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/indexStyle.css">
    <title>Document</title>
</head>
<body>
    <?php if (!empty($_GET['pesan']) && $_GET['pesan'] == "hapus_gagal"): ?>
        <div class="error-container">
            <p>Data tidak dapat dihapus karena masih digunakan di tabel lain!</p>
        </div>
    <?php endif; ?>
    <h1>Data Master Supplier</h1>
    <button type="button" class="btn-tambah" onclick="window.location.href='create.php'">Tambah Data</button>
    <br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php foreach($result as $row): ?>
            <tr>
                <td><?= $row['id'] . "<br>"; ?></td>
                <td><?= $row['nama'] . "<br>"; ?></td>
                <td><?= $row['telp'] . "<br>"; ?></td>
                <td><?= $row['alamat'] . "<br>"; ?></td>
                <td>
                    <button type="button" class="btn-edit" onclick="window.location.href='edit.php?id=<?= $row['id'] ?>'">Edit</button>
                    <button type="button" class="btn-hapus" onclick="if (confirm('Yakin ingin menghapus supplier dengan id <?= $row['id'] ?>')) { window.location.href='delete.php?id=<?= $row['id'] ?>'; }">Hapus</button>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>