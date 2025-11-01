<?php
include "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($conn, "DELETE FROM modul5 WHERE id = '$id'");
    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
    }
}

$sql = "SELECT * FROM modul5";
$query = mysqli_query($conn, $sql);

$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<html>
    <head>
        <title>Data Supplier</title>
    </head>
    <body>
        <h2>Data Master Supplier</h2>
        <a href="tambah.php">Tambah Data</a><br><br>

        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>

            <?php foreach($result as $row): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo $row["telp"]; ?></td>
                <td><?php echo $row["alamat"]; ?></td>
                <td>
                    <a href="Edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="index.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Yakinn ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
