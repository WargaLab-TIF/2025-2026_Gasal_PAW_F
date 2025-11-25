<?php
$conn = new mysqli("localhost", "root", "", "tp5");

$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        a.tambah {
            background-color: #28a745;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            float: right;
            margin-bottom: 10px;
        }
        a.tambah:hover { background-color: #218838; }

        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover { background-color: #f9f9f9; }

        a.btn-edit {
            background-color: orange;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }
        a.btn-edit:hover { background-color: darkorange; }

        a.btn-hapus {
            background-color: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        a.btn-hapus:hover { background-color: darkred; }
    </style>
</head>
<body>
    <h2>Data Master Supplier</h2>
    <a href="create.php" class="tambah">Tambah Data</a>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $no = 1;
        foreach($result as $row): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['no']; ?>" class="btn-edit">Edit</a>
                <a href="delete.php?id=<?php echo $row['no']; ?>" class="btn-hapus"
                onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
