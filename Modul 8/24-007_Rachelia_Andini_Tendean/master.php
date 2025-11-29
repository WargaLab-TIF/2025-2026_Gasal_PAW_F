<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 1) {
    echo "<h1>Akses Ditolak!</h1><p>Hanya Owner yang dapat mengakses Data Master.</p><a href='index.php'>Kembali</a>";
    exit;
}

//Data User
$user_query = mysqli_query($koneksi, "SELECT * FROM user");

//Data Barang
$barang_query = mysqli_query($koneksi, "SELECT * FROM barang");

//Data Supplier
$supplier_query = mysqli_query($koneksi, "SELECT * FROM supplier");

//Data Pelanggan
$pelanggan_query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Terpusat</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        h2 { text-align: center; background: #007bff; color: #fff; padding: 10px; border-radius: 5px; }
        h3 { margin-bottom: 8px; color: #333; }
        .box { background: #fff; padding: 15px; border-radius: 10px; margin: 20px 0; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #007bff; color: #fff; }
        tr:hover { background: #f1f1f1; }
        a { text-decoration: none; color: #fff; padding: 5px 10px; border-radius: 5px; display: inline-block; }
        button { padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
        .tambah { background: #28a745; color: white; margin-bottom: 15px; float: right; }
        .edit { background: #ff9f00; color: white; }
        .hapus { background: #dc3545; color: white; }
        button:hover { opacity: 0.8; }
        .header-section { overflow: auto; margin-bottom: 10px; }
        .header-section h3 { float: left; margin-top: 5px; }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="padding: 20px;">
        <h2>Data Master Terpusat (Owner)</h2>
        <hr>
        
        <div class="header-section">
            <h3>Data User</h3>
            <a href="tambah_user.php" class="tambah">Tambah User</a>
        </div>
        <table border="1" style="width:100%; margin-top:10px;">
            <tr><th>Username</th><th>Nama</th><th>Level</th><th>Aksi</th></tr>
            <?php while ($row = mysqli_fetch_assoc($user_query)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= $row['level'] == 1 ? 'Owner' : 'Kasir' ?></td>
                    <td>
                    <form action="edit_user.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id_user'] ?>">
                        <button class="edit" type="submit">Edit</button>
                    </form>
                    <form action="hapus_user.php" method="post" style="display:inline;" onsubmit="return confirm('Anda yakin akan menghapus user ini?');">
                        <input type="hidden" name="id" value="<?= $row['id_user'] ?>">
                        <input type="hidden" name="action" value="delete"> 
                        <button class="hapus" type="submit">Hapus</button>
                    </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br>

        <div class="header-section">
            <h3>Data Barang</h3>
            <a href="tambah_barang.php" class="tambah">Tambah Barang</a>
        </div>
        <table border="1" style="width:100%; margin-top:10px;">
            <tr><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
            <?php while ($row = mysqli_fetch_assoc($barang_query)): ?>
                <tr><td><?= $row['nama_barang'] ?></td><td><?= $row['harga'] ?></td><td><?= $row['stok'] ?></td>
                <td>
                <form action="edit_barang.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="edit" type="submit">Edit</button>
                </form>
                <form action="hapus_barang.php" method="post" style="display:inline;" onsubmit="return confirm('Anda yakin akan menghapus barang ini?');">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="delete"> 
                    <button class="hapus" type="submit">Hapus</button>
                </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <br>

        <div class="header-section">
        <h3>Data Supplier</h3>
        <a href="tambah_supplier.php" class="tambah">Tambah Supplier</a>
        </div>
        <table border="1" style="width:100%; margin-top:10px;">
            <tr><th>Nama</th><th>Telp</th><th>Alamat</th><th>Email</th><th>Aksi</th></tr>
            
            <?php while ($row = mysqli_fetch_assoc($supplier_query)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['telp']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    
                    <td><?= htmlspecialchars($row['email']) ?></td> 
                    
                    <td>
                    <form action="edit_supplier.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="edit" type="submit">Edit</button>
                    </form>
                    <form action="hapus_supplier.php" method="post" style="display:inline;" onsubmit="return confirm('Anda yakin akan menghapus supplier ini?');">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="action" value="delete"> 
                        <button class="hapus" type="submit">Hapus</button>
                    </form>
                    </td>
                </tr>
                <?php endwhile; ?>
        </table>
        <br>

        <div class="header-section">
            <h3>Data Pelanggan</h3>
            <a href="tambah_pelanggan.php" class="tambah">Tambah Pelanggan</a>
        </div>
        <table border="1" style="width:100%; margin-top:10px;">
            <tr><th>Nama</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr>
            <?php while ($row = mysqli_fetch_assoc($pelanggan_query)): ?>
                <tr><td><?= $row['nama'] ?></td><td><?= $row['telp'] ?></td><td><?= $row['alamat'] ?></td>
                <td>
                <form action="edit_pelanggan.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="edit" type="submit">Edit</button>
                </form>
                <form action="hapus_pelanggan.php" method="post" style="display:inline;" onsubmit="return confirm('Anda yakin akan menghapus pelanggan ini?');">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="action" value="delete"> 
                    <button class="hapus" type="submit">Hapus</button>
                </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>