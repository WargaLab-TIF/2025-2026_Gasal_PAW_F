<?php
session_start();
require 'koneksi.php';

// PROTEKSI HALAMAN: Hanya Level 1 (Owner)
if(!isset($_SESSION['status']) || $_SESSION['level'] != 1){
    header("location:index.php");
    exit();
}

// PROSES TAMBAH USER
if(isset($_POST['simpan'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $lvl = $_POST['level'];
    mysqli_query($koneksi, "INSERT INTO user VALUES(NULL, '$username', '$password', '$nama', '$alamat', '$hp', '$lvl')");
    header("location:data_user.php");
}

// PROSES HAPUS USER
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");
    header("location:data_user.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="sidebar">
        <h2>Sistem Toko</h2>
        <a href="index.php">Dashboard</a>
        <div class="menu-label">Data Master</div>
        <a href="data_barang.php">Data Barang</a>
        <a href="data_supplier.php">Data Supplier</a>
        <a href="data_pelanggan.php">Data Pelanggan</a>
        <a href="data_user.php" style="background:#494e53; color:#fff;">Data User</a>
        <div class="menu-label">Lainnya</div>
        <a href="transaksi.php">Transaksi</a>
        <a href="report_transaksi.php">Laporan</a>
        <br><a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content">
        <div class="card">
            <h3>Tambah User Baru</h3>
            <form method="POST">
                <div style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Username</label>
                        <input type="text" name="username" required>
                    </div>
                    <div style="flex:1;">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                </div>
                
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>
                
                <label>Alamat</label>
                <input type="text" name="alamat" required>
                
                <div style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>No HP</label>
                        <input type="text" name="hp" required>
                    </div>
                    <div style="flex:1;">
                        <label>Level</label>
                        <select name="level" required>
                            <option value="1">Level 1 (Owner)</option>
                            <option value="2">Level 2 (Kasir)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn-simpan">Simpan User</button>
            </form>
        </div>

        <div class="card">
            <h3>Daftar User</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM user");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['username']; ?></td>
                        <td><?= $d['nama']; ?></td>
                        <td><?= ($d['level']==1)?'<span style="color:blue; font-weight:bold;">Owner</span>':'Kasir'; ?></td>
                        <td>
                            <a href="data_user.php?hapus=<?= $d['id_user']; ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>