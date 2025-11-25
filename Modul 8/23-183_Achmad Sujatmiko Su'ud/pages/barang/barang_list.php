<?php
// pages/barang/barang_list.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

$sql = "SELECT b.*, s.nama_supplier 
        FROM barang b 
        LEFT JOIN supplier s ON b.id_supplier = s.id_supplier
        ORDER BY b.id_barang DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <h2 style="margin-top: 25px;">Data Barang</h2>

    <div style="width:90%; margin:auto; margin-bottom: 15px; text-align: left;">
        <a class="btn btn-blue" href="barang_tambah.php">Tambah Barang</a>
        <a class="btn btn-grey" href="../../index.php">Kembali</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id_barang'] ?></td>
                <td><?= $row['kode_barang'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= number_format($row['harga_beli']) ?></td>
                <td><?= number_format($row['harga_jual']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $row['nama_supplier'] ?? '—' ?></td>
                <td>
                    <a class="btn btn-blue" href="barang_edit.php?id=<?= $row['id_barang'] ?>">Edit</a>
                    <a class="btn btn-red" href="barang_hapus.php?id=<?= $row['id_barang'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>