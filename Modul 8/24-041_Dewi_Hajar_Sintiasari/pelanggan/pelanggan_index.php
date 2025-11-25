<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>

<style>
    body {
        background: #f5f5f5;
        margin: 0;
        padding: 0;
        font-family: Arial;
    }

    .container {
        width: 90%;
        margin: 25px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
        background: #0274bd;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-top: 0;
        font-size: 20px;
    }
    .btn {
        padding: 8px 12px;
        background: #0274bd;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .btn:hover {
        background: #0264a5;
    }

    .action {
        font-weight: bold;
        text-decoration: none;
        margin: 0 5px;
    }
    .hapus, .edit {
        color: blue;
    }
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    table th {
        padding: 10px;
        background: #0274bd;
        color: white;
        border: 1px solid #ccc;
    }

    table td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
    }
</style>

</head>
<body>

<div class="container">

    <h2>Data Pelanggan</h2>

    <a href="pelanggan_tambah.php" class="btn">+ Tambah Pelanggan</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Aksi</th>
        </tr>

        <?php while($data = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['nama'] ?></td>
            <td><?= $data['alamat'] ?></td>
            <td><?= $data['telp'] ?></td>

            <td>
                <a href="pelanggan_edit.php?id=<?= $data['id'] ?>" class="action edit">Edit</a>
                |
                <a href="pelanggan_hapus.php?id=<?= $data['id'] ?>" 
                   class="action hapus"
                   onclick="return confirm('Yakin ingin hapus?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>