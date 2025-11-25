<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$barang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi Detail</title>

<style>
    body { font-family: Arial; 
        margin: 0; 
        background: #f4f4f4; }
    .container { 
        margin:20px; 
        padding:20px; 
        background: #f5f5f5; 
        border-radius:5px; }
    label { font-weight:bold; }
    input, select { 
        padding:8px; 
        width:250px; 
        border:1px solid #f5f5f5; border-radius:4px; 
    }

    .btn { 
        padding:10px 15px; 
        background:#0274bd; 
        color:white; 
        text-decoration:none; 
        border:none; 
        border-radius:4px; }
    .btn:hover { background:#0264a5; }
</style>
</head>
<body>
<div class="container">
    <h2>Tambah Transaksi Detail</h2>

    <form action="proses_tambah_transaksi_detail.php" method="POST">

        <label>ID Transaksi</label><br>
        <select name="id" required>
            <option value="">--Pilih--</option>
            <?php while($row=mysqli_fetch_assoc($transaksi)): ?>
            <option value="<?= $row['id']; ?>"><?= $row['id']; ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label>Barang</label><br>
        <select name="id_barang" required>
            <option value="">--Pilih--</option>
            <?php while($row=mysqli_fetch_assoc($barang)): ?>
            <option value="<?= $row['id']; ?>"><?= $row['nama_barang']; ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Quantity</label><br>
        <input type="number" name="qty" required><br><br>

        <button type="submit" class="btn">Simpan</button>
    </form>
</div>
</body>
</html>