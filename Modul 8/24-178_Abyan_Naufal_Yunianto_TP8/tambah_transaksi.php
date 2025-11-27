<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}
include 'koneksi.php';
$level = $_SESSION['level'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu = $_POST['waktu_transaksi'];
    $ket = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelanggan = $_POST['pelanggan_id'];
    
    $koneksi->query("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$waktu', '$ket', $total, '$pelanggan')");
    echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='transaksi.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="sidebar">
        <h2>Sistem Toko</h2>
        <a href="index.php">Dashboard</a>
        <?php if($level == 1) { ?>
            <div class="menu-label">Data Master</div>
            <a href="data_barang.php">Data Barang</a>
            <a href="data_supplier.php">Data Supplier</a>
            <a href="data_pelanggan.php">Data Pelanggan</a>
            <a href="data_user.php">Data User</a>
        <?php } ?>
        <div class="menu-label">Transaksi</div>
        <a href="transaksi.php" style="background:#494e53; color:#fff;">Data Transaksi</a>
        <a href="report_transaksi.php">Laporan</a>
        <br><a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content">
        <div class="card" style="max-width: 600px;">
            <h3>Tambah Transaksi Baru</h3>
            <form method="POST">
                <label>Tanggal Transaksi</label>
                <input type="date" name="waktu_transaksi" required>
                
                <label>Keterangan</label>
                <textarea name="keterangan" minlength="3" required placeholder="Contoh: Pembelian Laptop Gaming"></textarea>
                
                <label>Total (Rp)</label>
                <input type="number" value="0" name="total" required>
                
                <label>Pelanggan</label>
                <select name="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php
                        $q = $koneksi->query("SELECT * FROM pelanggan");
                        while ($p = $q->fetch_assoc()) {
                            echo "<option value='{$p['id']}'>{$p['nama']}</option>";
                        }
                    ?>
                </select>
                
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-simpan">Simpan</button>
                    <a href="transaksi.php" class="btn-batal">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>