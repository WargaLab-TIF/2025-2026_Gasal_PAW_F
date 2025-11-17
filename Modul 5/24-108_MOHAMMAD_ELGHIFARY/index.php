<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "store";
$koneksi = mysqli_connect($servername, $username, $password, $db);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM supplier";
$query = mysqli_query($koneksi, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
    <style>
        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 640px;
            margin-bottom: 10px;
        }
        h2 {
            margin: 0;
        }
        button {
            border-radius: 5px;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .edit {
            background-color: orange;
        }
        .edit:hover {
            background-color: darkorange;
        }
        .hapus {
            background-color: red;
        }
        .hapus:hover {
            background-color: darkred;
        }
        .tambah {
            background-color: green;
        }
        .tambah:hover {
            background-color: darkgreen;
        }
        th {
            background-color: lightblue;
        }
        td form {
            display: inline-block;
            margin: 0 3px;
        }
    </style>
</head>
<body>
    <div class="head">
        <h2 class="judul">supplier</h2>
        <form action="tambah.php" method="get" class="formTambah">
            <button class="tambah" type="submit">Tambah</button>
        </form>
    </div>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php foreach ($result as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['telp'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td>
                <form action="update.php" method="get">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="edit" type="submit">Edit</button>
                </form>
                <form action="hapus.php" method="get" onsubmit="return confirm('Anda yakin akan menghapus supplier ini?')">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="hapus" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
