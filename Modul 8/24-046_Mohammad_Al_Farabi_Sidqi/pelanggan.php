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
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
    header("Location: pelanggan.php");
}

if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $hp     = $_POST['hp'];

    mysqli_query($conn, "INSERT INTO pelanggan VALUES ('', '$nama', '$alamat', '$hp')");
    header("Location: pelanggan.php");
}

if (isset($_POST['update'])) {
    $id     = $_POST['id_pelanggan'];
    $nama   = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $hp     = $_POST['hp'];

    mysqli_query($conn, "UPDATE pelanggan SET nama_pelanggan='$nama', alamat='$alamat', hp='$hp' 
                         WHERE id_pelanggan='$id'");
    header("Location: pelanggan.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
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
    <h2>Data Pelanggan</h2>
    <form action="" method="POST">
        <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
        <input type="text" name="alamat" placeholder="Alamat">
        <input type="text" name="hp" placeholder="No HP">
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM pelanggan");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nama_pelanggan']; ?></td>
                <td><?= $d['alamat']; ?></td>
                <td><?= $d['hp']; ?></td>
                <td>
                    <a href="pelanggan.php?edit=<?= $d['id_pelanggan']; ?>">Edit</a> |
                    <a href="pelanggan.php?hapus=<?= $d['id_pelanggan']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>

    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
        $e = mysqli_fetch_array($edit);
    ?>
        <hr>
        <h3>Edit Pelanggan</h3>
        <form action="" method="POST">
            <input type="hidden" name="id_pelanggan" value="<?= $e['id_pelanggan']; ?>">
            <input type="text" name="nama_pelanggan" value="<?= $e['nama_pelanggan']; ?>" required>
            <input type="text" name="alamat" value="<?= $e['alamat']; ?>">
            <input type="text" name="hp" value="<?= $e['hp']; ?>">
            <button type="submit" name="update">Update</button>
        </form>
    <?php } ?>

</body>

</html>