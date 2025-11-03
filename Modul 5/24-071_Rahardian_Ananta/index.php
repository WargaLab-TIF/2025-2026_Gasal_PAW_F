<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($servername, $username, $password,$database);

$sql = "SELECT * FROM supplier";
$query = mysqli_query($conn, $sql);

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>


<html lang="en">
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
    .tombol_merah{
        background-color:red;
        padding:5px;
        padding-right:10px;
        padding-left:10px;
        border-radius:3px;
        border:none;
    }
    .tombol_oren{
        background-color:orange;
        padding:5px;
        padding-right:10px;
        padding-left:10px;
        border-radius:3px;
        border:none;
    }
    .tombol_hijau{
        background-color:green;
        padding:5px;
        padding-right:10px;
        padding-left:10px;
        border-radius:3px;
        border:none;
    }
    a{
        color:white;
    }
    </style>
    </head>
    <button class="tombol_hijau"><a href="create.php" style="text-decoration:none;">Tambah Data</a></button>
    <body>
        <h1>Data Master Supplier</h1>
        <table border="1">
            <tr style="background-color:cyan;">
                <td>id</td>
                <td>nama</td>
                <td>telp</td>
                <td>alamat</td>
                <td>tindakan</td>
            </tr>
            <?php foreach($result as $row): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo $row["telp"]; ?></td>
                <td><?php echo $row["alamat"]; ?></td>
                <td>
                    <button class="tombol_oren"><a href="update.php?id=<?php echo $row["id"]?>" style="text-decoration:none;">Edit</a></button> |
                    <button class="tombol_merah" onclick="return confirm('Yakin ingin menghapus item ini?');">
                        <a href="delete.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;">Hapus
                        </a>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
