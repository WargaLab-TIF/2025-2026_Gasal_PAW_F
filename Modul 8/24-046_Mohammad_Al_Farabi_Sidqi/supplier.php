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
    mysqli_query($conn, "DELETE FROM supplier WHERE id_supplier='$id'");
    header("Location: supplier.php");
}

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $hp     = $_POST['hp'];

    mysqli_query($conn, "INSERT INTO supplier VALUES ('', '$nama', '$alamat', '$hp')");
    header("Location: supplier.php");
}

if (isset($_POST['update'])) {
    $id     = $_POST['id_supplier'];
    $nama   = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $hp     = $_POST['hp'];

    mysqli_query($conn, "UPDATE supplier SET nama_supplier='$nama', alamat='$alamat', hp='$hp' WHERE id_supplier='$id'");
    header("Location: supplier.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
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
    <?php include "header.php";?>
    <h2>Data Supplier</h2>
    <form action="" method="POST">
        <input type="text" name="nama_supplier" placeholder="Nama Supplier" required>
        <input type="text" name="alamat" placeholder="Alamat">
        <input type="text" name="hp" placeholder="No HP">
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM supplier");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nama_supplier']; ?></td>
                <td><?= $d['alamat']; ?></td>
                <td><?= $d['hp']; ?></td>
                <td>
                    <a href="supplier.php?edit=<?= $d['id_supplier']; ?>">Edit</a> |
                    <a href="supplier.php?hapus=<?= $d['id_supplier']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = mysqli_query($conn, "SELECT * FROM supplier WHERE id_supplier='$id'");
        $e = mysqli_fetch_array($edit);
    ?>
        <hr>
        <h3>Edit Supplier</h3>
        <form action="" method="POST">
            <input type="hidden" name="id_supplier" value="<?= $e['id_supplier']; ?>">
            <input type="text" name="nama_supplier" value="<?= $e['nama_supplier']; ?>" required>
            <input type="text" name="alamat" value="<?= $e['alamat']; ?>">
            <input type="text" name="hp" value="<?= $e['hp']; ?>">
            <button type="submit" name="update">Update</button>
        </form>
    <?php } ?>

</body>

</html>