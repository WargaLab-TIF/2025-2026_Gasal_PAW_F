<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'store';

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM supplier";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

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
            color: #3bd8ffff;
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

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #cdcdcdff;
            text-align: left;
        }
        th {
            background-color: #3bd8ffff;
        }

        a.btn-edit {
            color: white;
            text-decoration: none;
            background-color: orange;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }

        a.btn-hapus {
            background-color: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
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
        <?php foreach($result as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-hapus"
                onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>