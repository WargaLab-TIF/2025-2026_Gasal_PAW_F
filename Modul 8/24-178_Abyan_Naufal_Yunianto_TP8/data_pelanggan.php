<?php
session_start();
include 'koneksi.php';

// CEK SECURITY: Hanya Level 1
if(!isset($_SESSION['status']) || $_SESSION['level'] != 1){
    header("location:index.php");
    exit();
}

// PROSES TAMBAH
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES ('$nama', '$jk', '$telp', '$alamat')");
    echo "<script>alert('Pelanggan Berhasil Ditambahkan'); window.location='data_pelanggan.php';</script>";
}

// PROSES HAPUS
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id='$id'");
    header("location:data_pelanggan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="sidebar">
        <h2>Panel Owner</h2>
        <a href="index.php">Dashboard</a>
        <div class="menu-label">Data Master</div>
        <a href="data_barang.php">Data Barang</a>
        <a href="data_supplier.php">Data Supplier</a>
        <a href="data_pelanggan.php" style="background:#494e53; color:#fff;">Data Pelanggan</a>
        <a href="data_user.php">Data User</a>
        <div class="menu-label">Lainnya</div>
        <a href="transaksi.php">Transaksi</a>
        <a href="report_transaksi.php">Laporan</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content">
        <div class="card">
            <h3>Tambah Pelanggan</h3>
            <form method="POST">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" required>
                
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>

                <label>No Telepon</label>
                <input type="text" name="telp" required>
                
                <label>Alamat</label>
                <textarea name="alamat" rows="3" required></textarea>

                <button type="submit" name="simpan" class="btn btn-blue">Simpan Pelanggan</button>
            </form>
        </div>

        <div class="card">
            <h3>Daftar Pelanggan</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>L/P</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $q = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                    while($d = mysqli_fetch_assoc($q)){
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['nama']; ?></td>
                        <td><?= $d['jenis_kelamin']; ?></td>
                        <td><?= $d['telp']; ?></td>
                        <td><?= $d['alamat']; ?></td>
                        <td>
                            <a href="data_pelanggan.php?hapus=<?= $d['id']; ?>" class="btn btn-red" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>