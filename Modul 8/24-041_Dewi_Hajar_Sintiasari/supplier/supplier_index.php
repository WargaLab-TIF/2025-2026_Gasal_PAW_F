<?php
include '../session/cek_owner.php';
include '../koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>

<style>
    body {
        background: #f5f5f5;
        font-family: Arial;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
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
        padding: 10px 16px;
        background: #0274bd;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn:hover {
        background: #0264a5;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th {
        background: #0274bd;
        color: white;
        padding: 10px;
        border: 1px solid #ccc;
    }

    td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
    }

    /* Link Aksi */
    .action {
        font-weight: bold;
        text-decoration: none;
        margin-right: 8px;
    }

    .edit, .hapus {
        color: blue;
    }
</style>

</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">

    <h2>Data Supplier</h2>

    <a href="supplier_tambah.php" class="btn">+ Tambah Supplier</a><br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($row = mysqli_fetch_assoc($q)):
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['telp'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td>
                <a href="supplier_edit.php?id=<?= $row['id'] ?>" class="action edit">Edit</a> |
                <a href="supplier_hapus.php?id=<?= $row['id'] ?>" 
                   class="action hapus"
                   onclick="return confirm('Hapus supplier ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>

</div>

</body>
</html>