<?php
include '../session/cek_owner.php';
include '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>

<style>
    body {
        background: #f5f5f5;
        font-family: Arial;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    h2 {
        background: #0274bd;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin: 0 0 15px 0;
    }

    .btn {
        display: inline-block;
        padding: 8px 14px;
        background: #0274bd;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th {
        background: #0274bd;
        color: white;
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
    }

    a.action {
        color: blue;
        text-decoration: none;
        font-weight: bold;
    }

    a.action:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">

    <h2>Data Barang</h2>

    <a href="barang_tambah.php" class="btn">+ Tambah Barang</a>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, 
            "SELECT barang.*, supplier.nama AS supplier 
             FROM barang 
             LEFT JOIN supplier ON supplier.id = barang.supplier_id"
        );

        while ($row = mysqli_fetch_assoc($q)):
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['kode_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['supplier'] ?></td>
            <td>
                <a class="action" href="barang_edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a class="action" href="barang_hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus barang ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>

</div>

</body>
</html>