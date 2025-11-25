<?php 
$koneksi = mysqli_connect("localhost","root","","store");

$query = "SELECT * FROM supplier";
$result = mysqli_query($koneksi,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA SUPPLIER</title>
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <h2 style="text-align: center;" >DATA SUPPLIER</h2>
    <center><a href="tambah_supplier.php" class="tambah">Tambah data</a></center>
    <br><br>

    <center>
    <table border="1" cellpadding="5" cellspacing="0" style="text-align: center;">
        <tr class="atas">
            <th>ID</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)){ ?>
            <tr class="bawah">
                <td><?= $row['id']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['telp']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <a href="edit_supplier.php?id=<?= $row['id'];?>" class="edit">Edit</a>
                    <a href="hapus_supplier.php?id=<?= $row['id'];?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data ini ?')">Hapus</a>
                </td>
            </tr>
    <?php } ?>
</table>
</center>
</body>
</html>