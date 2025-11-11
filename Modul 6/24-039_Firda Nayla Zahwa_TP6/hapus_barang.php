<?php
require_once "koneksi.php"; 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            alert('Barang ini sudah digunakan dalam transaksi, tidak dapat dihapus!');
            document.location.href='hapus_barang.php';
        </script>";
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
        if ($hapus) {
            echo "<script>
                alert('Barang berhasil dihapus!');
                document.location.href='hapus_barang.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus barang!');
                document.location.href='hapus_barang.php';
            </script>";
        }
    }
}

$data_barang = mysqli_query($conn, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f8f8f8;
        }
        h2 {
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 70%;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background: #e4e4e4;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2>Data Barang</h2>
<table>
    <tr>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($b = mysqli_fetch_assoc($data_barang)): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= $b['nama_barang'] ?></td>
        <td><?= number_format($b['harga']) ?></td>
        <td><?= $b['stok'] ?></td>
        <td>
            <a href="hapus_barang.php?id=<?= $b['id'] ?>" 
               onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
