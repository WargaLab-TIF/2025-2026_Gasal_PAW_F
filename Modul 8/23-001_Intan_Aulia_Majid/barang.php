<?php
include "auth.php";
include "koneksi.php";

$sql = "SELECT b.id AS id_barang, b.kode_barang, b.nama_barang, b.harga, b.stok, b.supplier_id, s.id, s.nama 
        FROM barang AS b 
        INNER JOIN supplier AS s ON b.supplier_id = s.id";
$query = mysqli_query($koneksi,$sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>

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
            <?= isset($_SESSION['nama']) ?>
        </div>
    </div>

    <div class="content">

        <a href="admin.php">Kembali</a>
        <a href="proses/tambahBarang.php">Tambah Barang</a>
        <br><br>

        <table border="1" cellpadding="8">
            <tr>
                <th>id</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>

            <?php foreach($data as $row):?>
                <tr>
                    <td><?= htmlspecialchars($row['id_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($row['kode_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($row['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($row['harga'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($row['stok'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="./proses/hapusBarang.php?id=<?= $row['id_barang']?>">Hapus</a>
                        <a href="./proses/editBarang.php?id=<?= $row['id_barang']?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>

</body>
</html>
