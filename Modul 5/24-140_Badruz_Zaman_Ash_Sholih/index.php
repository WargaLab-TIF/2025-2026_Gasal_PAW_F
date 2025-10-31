<?php 
    $conn = mysqli_connect("Localhost", "root", "", "store");
    $sql = "SELECT * FROM supplier";
    $query = mysqli_query($conn, $sql);

    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Database</title>
    <style>
        body {
            font-family: verdana;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e0f2f1;
            color: #00796b;
        }

        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
            margin-right: 5px;
        }

        a[href="tambah.php"] {
            background-color: #5cb85c;
            display: inline-block;
            margin-bottom: 15px;
        }

        a[href^="edit.php"] {
            background-color: #f0ad4e;
        }

        a[href^="hapus.php"] {
            background-color: #d9534f;
        }
    </style>
</head>
<body>
    <h2>Data Master supplier</h2>

    <a href="tambah.php">Tambah Data</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php foreach($result as $row): ?>
            <tr>
                <td> <?php echo $row['id']; ?></td>
                <td> <?php echo $row['nama']; ?></td>
                <td> <?php echo $row['telp']; ?></td>
                <td> <?php echo $row['alamat']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']?>">Edit</a>
                    <a href="hapus.php?id=<?php echo $row['id']?>" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
                </td>
            </tr>        
        <?php endforeach; ?>
    </table>
</body>
</html>