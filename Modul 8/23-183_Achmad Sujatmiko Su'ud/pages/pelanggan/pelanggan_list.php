<?php
// pages/pelanggan/pelanggan_list.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

$sql = "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <h2 style="margin-top: 25px;">Data Pelanggan</h2>

    <div style="width:90%; margin:auto; margin-bottom: 15px; text-align: left;">
        <a class="btn btn-blue" href="pelanggan_tambah.php">Tambah Pelanggan</a>
        <a class="btn btn-grey" href="../../index.php">Kembali</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id_pelanggan'] ?></td>
                <td><?= $row['nama_pelanggan'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['hp'] ?></td>
                <td>
                    <a class="btn btn-blue" href="pelanggan_edit.php?id=<?= $row['id_pelanggan'] ?>">Edit</a>
                    <a class="btn btn-red" href="pelanggan_hapus.php?id=<?= $row['id_pelanggan'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>