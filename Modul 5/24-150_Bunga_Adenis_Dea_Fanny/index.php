<?php
include "koneksi.php";

$sql   = "SELECT * FROM supplier";
$query = mysqli_query($conn, $sql);
$result = $query ? mysqli_fetch_all($query, MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
</head>
<body>
    <h2>Data Master Supplier</h2>

    <a href="tambah.php">Tambah Data</a><br><br>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php if (empty($result)): ?>
            <tr><td colspan="5" align="center">Belum ada data</td></tr>
        <?php else: $no=1; foreach($result as $row): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['telp']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
    </table>
</body>
</html>
