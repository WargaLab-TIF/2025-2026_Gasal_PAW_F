<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: user.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id'");
    header("Location: barang.php");
}

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama_barang'];
    $beli   = $_POST['harga_beli'];
    $jual   = $_POST['harga_jual'];
    $stok   = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO barang VALUES('', '$nama', '$beli', '$jual', '$stok')");
    header("Location: barang.php");
}

if (isset($_POST['update'])) {
    $id     = $_POST['id_barang'];
    $nama   = $_POST['nama_barang'];
    $beli   = $_POST['harga_beli'];
    $jual   = $_POST['harga_jual'];
    $stok   = $_POST['stok'];

    mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', harga_beli='$beli', harga_jual='$jual', stok='$stok' WHERE id_barang='$id'");
    header("Location: barang.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <style>
        h2 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px 10px;
        }

        .del {
            color: red;
        }
    </style>
</head>

<body>

    <?php include "header.php"; ?>
    <h2>Data Barang</h2>
    <form action="" method="POST">
        <input type="text" name="nama_barang" placeholder="Nama Barang" required>
        <input type="number" name="harga_beli" placeholder="Harga Beli" required>
        <input type="number" name="harga_jual" placeholder="Harga Jual" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM barang");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nama_barang']; ?></td>
                <td><?= $d['harga_beli']; ?></td>
                <td><?= $d['harga_jual']; ?></td>
                <td><?= $d['stok']; ?></td>
                <td>
                    <a href="barang.php?edit=<?= $d['id_barang']; ?>">Edit</a> |
                    <a class="del" href="barang.php?hapus=<?= $d['id_barang']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
        $e = mysqli_fetch_array($edit);
    ?>
        <hr>
        <h3>Edit Data Barang</h3>
        <form action="" method="POST">
            <input type="hidden" name="id_barang" value="<?= $e['id_barang']; ?>">
            <input type="text" name="nama_barang" value="<?= $e['nama_barang']; ?>" required>
            <input type="number" name="harga_beli" value="<?= $e['harga_beli']; ?>" required>
            <input type="number" name="harga_jual" value="<?= $e['harga_jual']; ?>" required>
            <input type="number" name="stok" value="<?= $e['stok']; ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
    <?php } ?>

</body>

</html>