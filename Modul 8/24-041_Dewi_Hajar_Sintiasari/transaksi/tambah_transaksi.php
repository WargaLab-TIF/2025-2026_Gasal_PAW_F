<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
$barang_list = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>

<style>
    body { font-family: Arial; 
        margin: 0; 
        background: #f4f4f4; 
    }
    .container { 
        margin:20px; 
        padding:20px; 
        background:#f5f5f5; 
        border-radius:5px; 
    }
    label { 
        font-weight:bold; 
    }
    input, select { 
        padding:8px; 
        width:250px; 
        border:1px solid #999; 
        border-radius:4px; 
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
    <h2>Tambah Transaksi</h2>

    <form action="proses_tambah_transaksi.php" method="POST">

        <label>Pelanggan</label><br>
        <select name="id_pelanggan" required>
            <option value="">--Pilih--</option>
            <?php while($row=mysqli_fetch_assoc($pelanggan)): ?>
            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <label>Keterangan</label><br>
        <input type="text" name="keterangan" required><br><br>

        <label>Total</label><br>
        <input type="number" name="total" required><br><br>

        <button type="submit" class="btn">Simpan</button>

    </form>
</div>
</body>
</html>