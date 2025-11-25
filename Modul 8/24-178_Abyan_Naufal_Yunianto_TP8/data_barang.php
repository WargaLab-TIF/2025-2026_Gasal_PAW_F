<?php
session_start();
include 'koneksi.php';

// PROTEKSI LEVEL: Hanya Owner (1)
if($_SESSION['status'] != "login" || $_SESSION['level'] != 1){
    header("location:index.php");
    exit();
}

// PROSES TAMBAH & HAPUS (Dalam satu file agar ringkas)
if(isset($_POST['simpan'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $sup = $_POST['supplier_id'];
    mysqli_query($koneksi, "INSERT INTO barang VALUES(NULL, '$kode', '$nama', '$harga', '$stok', '$sup')");
    header("location:data_barang.php");
}
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
    header("location:data_barang.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h3>Navigasi</h3>
    <a href="index.php">Kembali ke Dashboard</a>
</div>

<div class="content">
    <h2>Kelola Data Barang</h2>
    
    <div class="card">
        <h3>Tambah Barang</h3>
        <form method="POST">
            <input type="text" name="kode" placeholder="Kode Barang" required>
            <input type="text" name="nama" placeholder="Nama Barang" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="number" name="stok" placeholder="Stok" required>
            <select name="supplier_id" required>
                <option value="">Pilih Supplier</option>
                <?php
                $s = mysqli_query($koneksi, "SELECT * FROM supplier");
                while($row = mysqli_fetch_assoc($s)){
                    echo "<option value='".$row['id']."'>".$row['nama']."</option>";
                }
                ?>
            </select>
            <button type="submit" name="simpan" class="btn-primary">Simpan</button>
        </form>
    </div>

    <div class="card">
        <h3>Daftar Barang</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM barang");
            while($d = mysqli_fetch_assoc($data)){
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['kode_barang']; ?></td>
                <td><?= $d['nama_barang']; ?></td>
                <td><?= $d['harga']; ?></td>
                <td><?= $d['stok']; ?></td>
                <td>
                    <a href="data_barang.php?hapus=<?= $d['id']; ?>" class="btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>