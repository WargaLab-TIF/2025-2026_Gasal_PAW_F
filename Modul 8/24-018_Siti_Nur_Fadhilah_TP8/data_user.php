<?php 

    session_start();
    require 'database/conn.php';

    // 1. Proteksi Halaman: Jika belum login, arahkan ke login.php 
    if (!isset($_SESSION['login'])){
        header('Location: login.php');
        exit;
    } 
    // 2. Proteksi Halaman: Hanya user Level 1 yang boleh mengakses 
    else if ($_SESSION['role'] != 1) { 
        header('Location: user.php');
        exit;
    }

    $query = "SELECT * FROM user";
    $result = mysqli_query($koneksi, $query);

    $no = 1;

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan - Admin/Owner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: powderblue;
            padding: 0;
        }

        .header {
            background-color: #3498db;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 20px;
        }

        .user-info {
            font-size: 14px;
        }

        .nav-bar {
            background-color: #2c3e50;
            padding: 10px 20px;
        }

        .nav-bar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav-bar ul li a {
            color: powderblue;
            text-decoration: none;
            padding: 8px 15px;
            display: block;
            transition: background 0.3s;
        }

        .nav-bar ul li a:hover {
            background-color: steelblue;
        }

        .content {
            padding: 20px;
        }

        h2 {
            color: #3498db;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .btn-tambah {
            background: #4CAF50;
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            float: right;
            margin-bottom: 10px;
        }

        .logout-link {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th {
            background: steelblue;
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .action {
            text-align: center;
            width: 150px;
        }

        .btn-edit, .btn-hapus {
            padding: 6px 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            color: white;
        }

        .btn-edit {
            background: royalblue;
            margin-right: 5px;
        }

        .btn-hapus {
            background: navy;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: steelblue;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <header>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <div class="user-info">
            Selamat Datang, <b><?= htmlspecialchars($_SESSION['nama_user']); ?></b> 
            (<?= $_SESSION['role'] == 1 ? 'Owner' : 'Kasir'; ?>)
        </div>
        <button>
        <a href="logout.php" onclick="return confirm('apakah anda yakin ingin logout??')" 
           style="text-decoration: none; color: #e74c3c; font-weight: bold;">Logout</a>
        </button>
    </div>
    <hr style="margin-bottom: 20px;">
</header>


    <div class="nav-bar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="#">Data Master</a> <div class="dropdown-content">
                    <a href="barang.php">Data Barang</a> <a href="supplier.php">Data Supplier</a> <a href="pelanggan.php">Data Pelanggan</a> <a href="data_user.php">Data User</a> </div>
            </li>
            <li><a href="transaksi.php">Transaksi</a></li> <li><a href="laporan.php">Laporan</a></li> </ul>
    </div>

    <div class="content">
        <h2>Data User (Master)</h2>

        <button class="btn-tambah" onclick="window.location.href='create.php'">Tambah User</button>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Tindakan</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)):?>
                    <tr>
                        <td><?= $no++ ;?></td>
                        <td><?=  htmlspecialchars($row['username'])?></td>
                        <td><?= htmlspecialchars($row['nama']);?></td>
                        <td><?= $row['level'] == 1? 'Admin/Owner': 'User Biasa/Kasir';?></td>
                        <td class="action">
                        <button class="btn-edit" 
                        onclick="window.location.href='edit.php?id=<?= $row['id_user'] ?>'">Edit</button>
                        <button class="btn-hapus" 
                        onclick="if(confirm('Yakin ingin menghapus user <?= htmlspecialchars($row['username']) ?>?')) 
                        window.location.href='delete.php?id=<?= $row['id_user'] ?>'">Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>

</body>
</html>