<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Barang tidak bisa dihapus karena sudah digunakan dalam transaksi detail!');
                window.location='index.php';
              </script>";
        exit();
    } else {
        mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
        echo "<script>
                alert('Barang berhasil dihapus.');
                window.location='index.php';
              </script>";
        exit();
    }
}

$sql_barang = "
    SELECT b.*, s.nama AS supplier 
    FROM barang b LEFT JOIN supplier s ON s.id = b.supplier_id
    ORDER BY b.id ASC
";
$barang = mysqli_query($conn, $sql_barang);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>
    <style>
        a {
            text-decoration: none;
            color: black;
            border: 1px solid black;
            padding: 2px 6px;
            border-radius: 3px;
        }
        th, td { 
            padding:6px; 
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Barang</h2>
    <table border="1" cellpadding="6" width="100%">
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>

        <?php while ($data_barang = mysqli_fetch_assoc($barang)): ?>
        <tr>
            <td><?= $data_barang['id'] ?></td>
            <td><?= htmlspecialchars($data_barang['kode_barang']) ?></td>
            <td><?= htmlspecialchars($data_barang['nama_barang']) ?></td>
            <td><?= number_format($data_barang['harga'], 0, ',', '.'); ?></td>
            <td><?= $data_barang['stok'] ?></td>
            <td><?= htmlspecialchars($data_barang['supplier']) ?></td>
            <td>
                <a href="index.php?id=<?= $data_barang['id']; ?>" 
                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                    Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</body>
</html>