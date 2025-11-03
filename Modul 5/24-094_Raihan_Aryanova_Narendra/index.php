<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "store";
$koneksi = mysqli_connect($servername,$username,$password, $database);
$sql = "SELECT * FROM supplier";
$query = mysqli_query($koneksi, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (!$koneksi) {
    echo "koneksi eror";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f6ff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            border-bottom: 3px solid #4a7bff;
            padding-bottom: 6px;
        }

        a[href="create.php"] {
            background: #4a7bff;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 15px;
            display: inline-block;
            transition: 0.2s;
        }

        a[href="create.php"]:hover {
            background: #345ce8;
        }

        table {
            border-collapse: collapse;
            width: 85%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 14px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background: #4a7bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background: #f4f7ff;
        }

        tr:hover {
            background: #e4ecff;
        }

        .edit, .delete {
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            color: white;
            text-decoration: none;
            transition: 0.2s;
        }

        .edit {
            background: #27ae60;
        }

        .edit:hover {
            background: #19944f;
        }

        .delete {
            background: #e74c3c;
            margin-left: 4px;
        }

        .delete:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <h2>Data Supplier</h2>
        <a href="create.php">Tambah Supplier</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>

            <?php foreach ($result as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['telp'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Anda akin ingin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
</body>
</html>
