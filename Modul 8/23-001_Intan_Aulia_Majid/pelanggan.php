<?php
include "auth.php";
include "koneksi.php";

$sql = "SELECT * FROM pelanggan";
$query = mysqli_query($koneksi,$sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #2c3e50;
            color: white;
        }

        .nav-left {
            display: flex;
            gap: 25px;
            font-size: 16px;
            align-items: center;
        }

        .nav-left a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-left a:hover {
            text-decoration: underline;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }

        .dropbtn:hover {
            text-decoration: underline;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #34495e;
            min-width: 160px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            overflow: hidden;
            z-index: 10;
        }

        .dropdown-content a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 14px;
        }

        .dropdown-content a:hover {
            background-color: #2c3e50;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .nav-right {
            font-weight: bold;
            font-size: 16px;
        }

        .content {
            padding: 25px 30px;
        }
    </style>

</head>
<body>

    <div class="navbar">
        <div class="nav-left">
            <a href="admin.php">Sistem Penjualan</a>
            <a href="admin.php">Home</a>

            <div class="dropdown">
                <button class="dropbtn">Data Master</button>
                <div class="dropdown-content">
                    <a href="barang.php">Data Barang</a>
                    <a href="supplier.php">Data Supplier</a>
                    <a href="pelanggan.php">Data Pelanggan</a>
                    <a href="user.php">Data User</a>
                </div>
            </div>

            <a href="transaksi.php">Transaksi</a>
            <a href="laporan.php">Laporan</a>
        </div>

        <div class="nav-right">
            <?= isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User' ?>
        </div>
    </div>

    <div class="content">

        <a href="admin.php">Kembali</a>
        <a href="proses/tambahPelanggan.php">Tambah Pelanggan</a>
        <br><br>

        <table border="1" cellpadding="8">
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>

            <?php foreach($data as $row):?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['telp'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td>
                        <a href="./proses/hapusPelanggan.php?id=<?= $row['id']?>">Hapus</a>
                        <a href="./proses/editPelanggan.php?id=<?= $row['id']?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

</body>
</html>
