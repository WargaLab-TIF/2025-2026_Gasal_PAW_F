<?php
include "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");

    if ($hapus) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
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
    <title>..</title>
</head>
<style>
    body {
        margin: 5%;
        background-color: blue;
    }

    .layout {
        border-radius: 10px;
        padding: 5%;
        background-color: white;
    }

    table {
        width: 100%;
    }

    th {
        background-color: aquamarine;
        padding: 10px;
        margin: 10px;
    }

    td {
        padding: 5px;
        margin: 5px;
    }

    .head {
        display: flex;
    }

    .headka {
        width: 90%;
    }

    .add {
        color: green;
    }

    .dell {
        color: red;
        width: 50%;
    }

    .chng {
        width: 50%;
        color: orange;
    }
</style>

<body>
    <div class="layout">
        <div class="head">
            <div class="headka">
                <h2>Data Master Suplier</h2>
            </div>
            <div class="add">
                [<a href="create.php">Tambah</a>]
            </div>
        </div>
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $i = 1;
            foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $i; $i++;?></td>
                    <td><?php echo $row["nama"] ?></td>
                    <td><?php echo $row["telp"] ?></td>
                    <td><?php echo $row["alamat"] ?></td>
                    <td>
                        <div class="head">
                            <div class="dell">[<a href="?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus <?php echo $row['nama']; ?> ?')">Hapus</a>]</div>
                            <div class="chng">[<a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a>]</div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>