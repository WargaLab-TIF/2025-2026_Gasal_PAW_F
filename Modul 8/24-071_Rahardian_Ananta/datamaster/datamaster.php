<?php
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: ../login.php");
        exit();
    }
    if ($_SESSION['level'] !== "Admin") {
        echo "<script>
            alert('Akses Ditolak! Halaman ini khusus Admin.');
            window.location='../index.php';
        </script>";
        exit();
    }
    require "../conn.php";
    $nama_user = $_SESSION['username'];
    $barang = mysqli_query($conn, "SELECT * FROM barang");
    $supplier = mysqli_query($conn, "SELECT * FROM supplier");
    $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
    $user = mysqli_query($conn, "SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Master</title>
        <style>
            body {
                margin:0;
                font-family:sans-serif;
            }
            .navbar  {
                width:100%;
                background:#333;
                color:white;
                padding:10px;
                display:flex;
                align-items:center;
            }
            .navbar a  {
                color:white;
                margin-right:20px;
                text-decoration:none;
                font-size:18px;
            }
            .navbar a:hover  {
                text-decoration:underline;
            }
            .user-menu  {
                margin-left:auto;
                position:relative;
                cursor:pointer;
                color:white;
                font-size:18px;
            }
            .dropdown  {
                display:none;
                position:absolute;
                right:0;
                background:#444;
                padding:10px;
                border-radius:5px;
            }
            .dropdown a  {
                display:block;
                color:white;
                text-decoration:none;
                padding:5px 10px;
            }
            .dropdown a:hover  {
                background:#555;
            }
            .user-menu:hover .dropdown  {
                display:block;
            }
            .tombol_merah, .tombol_oren, .tombol_hijau  {
                padding:6px 12px;
                border-radius:5px;
                border:none;
                color:white;
                cursor:pointer;
                font-weight:bold;
                font-size:14px;
                transition:0.2s;
            }
            .tombol_merah  {
                background:#e74c3c;
            }
            .tombol_merah:hover  {
                background:#c0392b;
            }
            .tombol_oren  {
                background:#f39c12;
            }
            .tombol_oren:hover  {
                background:#d35400;
            }
            .tombol_hijau  {
                background:#27ae60;
            }
            .tombol_hijau:hover  {
                background:#1e8449;
            }
            .tombol_merah a, .tombol_oren a, .tombol_hijau a  {
                color:white;
                text-decoration:none;
                display:block;
            }
            .tombol-hijau-container  {
                text-align:right;
                margin-bottom:10px;
            }
            .nav-tab  {
                margin:20px 0;
            }
            .nav-tab a  {
                padding:10px 15px;
                background:#eee;
                color:#333;
                margin-right:5px;
                text-decoration:none;
                cursor:pointer;
            }
            .nav-tab a.active  {
                background:#333;
                color:white;
            }
            .container  {
                max-width:1200px;
                margin:20px auto;
                padding:0 20px;
            }
            .table-wrapper  {
                overflow-x:auto;
            }
            table  {
                border-collapse:collapse;
                width:100%;
                min-width:600px;
            }
            th, td  {
                padding:8px 12px;
                border:1px solid #ccc;
                text-align:left;
            }
            th  {
                background:#333;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="../index.php">Home</a>
            <a href="#">Data Master</a>
            <a href="../transaksi/transaksi.php">Transaksi</a>
            <a href="../laporan/laporan.php">Laporan</a>
            <div class="user-menu">
                <?= $nama_user ?> ▼
                <div class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="container">
            <h1>Data Master</h1>
            <div class="nav-tab">
                <a class="active" onclick="showTab('barang', this)">Barang</a>
                <a onclick="showTab('supplier', this)">Supplier</a>
                <a onclick="showTab('pelanggan', this)">Pelanggan</a>
                <a onclick="showTab('user', this)">User</a>
            </div>
            <!-- TAB BARANG -->
            <div id="barang" style="display:block;">
                <h2>Data Barang</h2>
                <div class="tombol-hijau-container">
                    <button class="tombol_hijau"><a href="create_barang.php">Tambah Barang</a></button>
                </div>
                <table>
                    <tr><th>ID</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Supplier ID</th><th>Aksi</th></tr>
                    <?php while($row = mysqli_fetch_assoc($barang)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td>Rp<?= number_format($row['harga'],0,',','.') ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td><?= $row['supplier_id'] ?></td>
                        <td>
                            <button class="tombol_oren"><a href="update_barang.php?id=<?= $row['id'] ?>">Edit</a></button>
                            <button class="tombol_merah" onclick="return confirm('Yakin ingin menghapus?')"><a href="delete_barang.php?id=<?= $row['id'] ?>">Hapus</a></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <!-- TAB SUPPLIER -->
            <div id="supplier" style="display:none;">
                <h2>Data Supplier</h2>
                <div class="tombol-hijau-container">
                    <button class="tombol_hijau"><a href="create_supplier.php">Tambah Supplier</a></button>
                </div>
                <table>
                    <tr><th>ID</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr>
                    <?php while($row = mysqli_fetch_assoc($supplier)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td>
                            <button class="tombol_oren"><a href="update_supplier.php?id=<?= $row['id'] ?>">Edit</a></button>
                            <button class="tombol_merah" onclick="return confirm('Yakin ingin menghapus?')"><a href="delete_supplier.php?id=<?= $row['id'] ?>">Hapus</a></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <!-- TAB PELANGGAN -->
            <div id="pelanggan" style="display:none;">
                <h2>Data Pelanggan</h2>
                <div class="tombol-hijau-container">
                    <button class="tombol_hijau"><a href="create_pelanggan.php">Tambah Pelanggan</a></button>
                </div>
                <table>
                    <tr><th>ID</th><th>Nama</th><th>Jenis Kelamin</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr>
                    <?php while($row = mysqli_fetch_assoc($pelanggan)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td>
                            <button class="tombol_oren"><a href="update_pelanggan.php?id=<?= $row['id'] ?>">Edit</a></button>
                            <button class="tombol_merah" onclick="return confirm('Yakin ingin menghapus?')"><a href="delete_pelanggan.php?id=<?= $row['id'] ?>">Hapus</a></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <!-- TAB USER -->
            <div id="user" style="display:none;">
                <h2>Data User</h2>
                <div class="tombol-hijau-container">
                    <button class="tombol_hijau"><a href="create_user.php">Tambah User</a></button>
                </div>
                <table>
                    <tr><th>ID</th><th>Username</th><th>Nama</th><th>Level</th><th>Aksi</th></tr>
                    <?php while($row = mysqli_fetch_assoc($user)): ?>
                    <tr>
                        <td><?= $row['id_user'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['level'] ?></td>
                        <td>
                            <button class="tombol_oren"><a href="update_user.php?id=<?= $row['id_user'] ?>">Edit</a></button>
                            <button class="tombol_merah" onclick="return confirm('Yakin ingin menghapus?')"><a href="delete_user.php?id=<?= $row['id_user'] ?>">Hapus</a></button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div> <!-- END CONTAINER -->
        <script>
            function showTab(id, el){
                document.getElementById('barang').style.display='none';
                document.getElementById('supplier').style.display='none';
                document.getElementById('pelanggan').style.display='none';
                document.getElementById('user').style.display='none';
                document.getElementById(id).style.display='block';
                document.querySelectorAll('.nav-tab a').forEach(a=>a.classList.remove('active'));
                el.classList.add('active');
            }
        </script>
    </body>
</html>