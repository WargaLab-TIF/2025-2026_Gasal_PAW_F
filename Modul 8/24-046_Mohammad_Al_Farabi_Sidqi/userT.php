<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: userT.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM user WHERE id_user='$id'");
    header("Location: userT.php");
}

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];

    mysqli_query($conn, "INSERT INTO user (username,password,nama,alamat,hp,level) VALUES ('$username','$password','$nama','$alamat','$hp','$level')");
    header("Location: userT.php");
}

if (isset($_POST['update'])) {
    $id       = $_POST['id_user'];
    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE user SET username='$username', password='$password', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id'");
    } else {
        mysqli_query($conn, "UPDATE user SET username='$username', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id'");
    }
    header("Location: userT.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data User</title>
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
    <h2>Data User</h2>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="text" name="alamat" placeholder="Alamat">
        <input type="text" name="hp" placeholder="No HP">
        <select name="level" required>
            <option value="">-- Pilih Level --</option>
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
        </select>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <hr>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM user");
        while ($d = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['username']; ?></td>
                <td><?= $d['nama']; ?></td>
                <td><?= $d['alamat']; ?></td>
                <td><?= $d['hp']; ?></td>
                <td><?= ($d['level'] == 1) ? 'Owner' : 'Kasir'; ?></td>
                <td>
                    <a href="?edit=<?= $d['id_user']; ?>">Edit</a> |
                    <a href="?hapus=<?= $d['id_user']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
        $e = mysqli_fetch_assoc($edit);
    ?>
        <hr>
        <h3>Edit User</h3>
        <form action="" method="POST">
            <input type="hidden" name="id_user" value="<?= $e['id_user']; ?>">
            <input type="text" name="username" value="<?= $e['username']; ?>" required>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
            <input type="text" name="nama" value="<?= $e['nama']; ?>" required>
            <input type="text" name="alamat" value="<?= $e['alamat']; ?>">
            <input type="text" name="hp" value="<?= $e['hp']; ?>">
            <select name="level">
                <option value="1" <?= ($e['level'] == 1 ? 'selected' : ''); ?>>Owner</option>
                <option value="2" <?= ($e['level'] == 2 ? 'selected' : ''); ?>>Kasir</option>
            </select>
            <button type="submit" name="update">Update</button>
        </form>
    <?php } ?>

</body>

</html>