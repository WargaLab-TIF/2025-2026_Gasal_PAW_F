<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qty = $_POST['qty'];
    $transaksi = $_POST['transaksi_id'];
    $barang = $_POST['barang_id'];
    
    $check = $koneksi->query("SELECT transaksi_id FROM transaksi_detail WHERE transaksi_id = '$transaksi' AND barang_id = '$barang'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Barang ini sudah ada dalam detail transaksi ini!');history.back();</script>";
        exit;
    }

    $q_barang = $koneksi->query("SELECT harga FROM barang WHERE id = '$barang'");
    $data_barang = $q_barang->fetch_assoc();
    $harga_satuan = $data_barang['harga'];
    
    // Perhitungan Harga = satuan kali qty
    $harga_detail = $harga_satuan * $qty; 

    // Menyimpan harga detail
    $koneksi->query("INSERT INTO transaksi_detail (barang_id, transaksi_id, qty, harga) 
                     VALUES ('$barang', '$transaksi', '$qty', '$harga_detail')");

    // hitung total harga
    $q_total = $koneksi->query("SELECT SUM(harga) AS total_baru FROM transaksi_detail WHERE transaksi_id = '$transaksi'");
    $data_total = $q_total->fetch_assoc();
    $total_baru = $data_total['total_baru'];

    // Update kolom total di tabel transaksi master
    $koneksi->query("UPDATE transaksi SET total = '$total_baru' WHERE id = '$transaksi'");
    
    echo "<script>alert('Detail Transaksi berhasil ditambahkan');window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
        <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2> Tambah Detail Transaksi</h2>
    <form method="POST">
        <label>Pilih Barang</label>
        <select name="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php
                $q = $koneksi->query("SELECT * FROM barang");
                while ($p = $q->fetch_assoc()) {
                    echo "<option value='{$p['id']}'>{$p['nama_barang']}(Rp" . number_format($p['harga'], 0, ',', '.') . ")</option>";
                }
            ?>
        </select>
        <label>ID Transaksi</label>
        <select name="transaksi_id" required>
            <option value="">-- Pilih Transaksi --</option>
            <?php
                $q = $koneksi->query("SELECT id, keterangan FROM transaksi ORDER BY id DESC");
                while ($p = $q->fetch_assoc()) {
                    echo "<option value='{$p['id']}'>ID: {$p['id']} | Ket: {$p['keterangan']}</option>";                }
            ?>
        </select>
        <label>Quantity</label>
        <input type="text" name="qty" min="1" placeholder="Masukkan jumlah barang" required>
        <button type="submit">Simpan</button>
        <a href="index.php" class="btn">Kembali</a>
    </form>
</body>
</html>