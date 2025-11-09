<?php
$conn = mysqli_connect("localhost", "root", "", "store");

$data = mysqli_query($conn, "SELECT * FROM supplier");
$result = mysqli_fetch_all($data, MYSQLI_ASSOC);
?>

<html>
<head>
    <title>Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .judul {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 600px;
            margin-bottom: 10px;
        }

        .btn {
            border: none;
            color: white;
            padding: 6px 12px;
            margin: 2px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-tambah {
            background: linear-gradient(to bottom, #33ccff, #0066cc);
        }

        .btn-tambah:hover {
            background: linear-gradient(to bottom, #0099ff, #004c99);
        }

        .btn-edit {
            background: linear-gradient(to bottom, #ff9900, #ff6600);
        }

        .btn-edit:hover {
            background: linear-gradient(to bottom, #ff6600, #ff3300);
        }

        .btn-hapus {
            background: linear-gradient(to bottom, #ff3333, #cc0000);
        }

        .btn-hapus:hover {
            background: linear-gradient(to bottom, #cc0000, #990000);
        }

        table {
            border-collapse: collapse;
            width: 600px;
        }

        th, td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #B8D7E9;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="judul">
        <h3>Data Master Supplier</h3>
        <a href="tambah.php" class="btn btn-tambah">Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php foreach ($result as $item): ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['nama']; ?></td>
                <td><?= $item['telp']; ?></td>
                <td><?= $item['alamat']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $item['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $item['id']; ?>" class="btn btn-hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
