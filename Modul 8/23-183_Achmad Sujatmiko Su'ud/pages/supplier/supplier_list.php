<?php
// pages/supplier/supplier_list.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

$sql = "SELECT * FROM supplier ORDER BY nama_supplier ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <h2 style="margin-top: 25px;">Data Supplier</h2>

    <div style="width:90%; margin:auto; margin-bottom: 15px; text-align: left;">
        <a class="btn btn-blue" href="supplier_tambah.php">Tambah Supplier</a>
        <a class="btn btn-grey" href="../../index.php">Kembali</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id_supplier'] ?></td>
                <td><?= $row['nama_supplier'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['hp'] ?></td>
                <td>
                    <a class="btn btn-blue" href="supplier_edit.php?id=<?= $row['id_supplier'] ?>">Edit</a>
                    <a class="btn btn-red" href="supplier_hapus.php?id=<?= $row['id_supplier'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>