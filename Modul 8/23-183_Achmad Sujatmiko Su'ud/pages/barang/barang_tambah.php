<?php
// pages/barang/barang_tambah.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

$suppliers = mysqli_query($conn, "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $beli = $_POST['harga_beli'];
    $jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['id_supplier'];

    mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, harga_beli, harga_jual, stok, id_supplier) 
                         VALUES ('$kode', '$nama', '$beli', '$jual', '$stok', '$supplier_id')");
    
    header("Location: barang_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <div class="container" style="width: 450px;">
        <h2 style="text-align:left; color: #007bff; margin-bottom: 25px;">Tambah Barang Baru</h2>

        <form method="POST">

            <label>Kode Barang</label>
            <input type="text" name="kode_barang" required>

            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
            
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" required min="0">

            <label>Harga Jual</label>
            <input type="number" name="harga_jual" required min="0">

            <label>Stok Awal</label>
            <input type="number" name="stok" required min="0">

            <label>Supplier</label>
            <select name="id_supplier">
                <option value="">-- Pilih Supplier --</option>
                <?php while ($s = mysqli_fetch_assoc($suppliers)) : ?>
                    <option value="<?= $s['id_supplier'] ?>"><?= $s['nama_supplier'] ?></option>
                <?php endwhile; ?>
            </select>

            <div style="margin-top: 20px;">
                <button class="btn btn-blue" type="submit">Simpan</button>
                <a class="btn btn-red" href="barang_list.php">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>