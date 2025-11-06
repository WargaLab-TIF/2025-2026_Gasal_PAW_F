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
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #2a6592;
            margin-bottom: 15px;
        }
        .btn-tambah {
            background-color: #84b02c;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
            float: right;
            margin-bottom: 15px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fefefe;
            font-size: 14px;
        }
        table thead {
            background-color: #d5e7f3;
        }
        table thead th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        table tbody td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .btn-edit {
            background-color: #f5821f;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
            font-weight: bold;
        }
        .btn-hapus {
            background-color: #d31515;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 3px;
            font-weight: bold;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>

    <h2>Data Master Supplier</h2>
    <a href="update.php" class="btn-tambah">Tambah Data</a>
    <div class="clear"></div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($result as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['telp']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
