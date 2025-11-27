<?php
// detail_transaksi.php

include 'koneksi.php'; 

// Ambil ID Transaksi dari parameter URL
$id_transaksi = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_transaksi === 0) {
    die("ID Transaksi tidak valid.");
}

// 1. Ambil Data Transaksi Utama
$query_utama = "SELECT 
                      t.id, 
                      t.waktu_transaksi, 
                      p.nama AS nama_pelanggan, 
                      t.keterangan,
                      t.total
                    FROM 
                      transaksi t
                    JOIN 
                      pelanggan p ON t.pelanggan_id = p.id
                    WHERE 
                      t.id = $id_transaksi";
$hasil_utama = $koneksi->query($query_utama);
$transaksi_data = $hasil_utama->fetch_assoc();

if (!$transaksi_data) {
    die("Transaksi tidak ditemukan.");
}

// 2. Ambil Detail Barang yang Dibeli
$query_detail = "SELECT 
                    b.kode_barang, 
                    b.nama_barang, 
                    td.harga AS harga_satuan, 
                    td.qty AS jumlah, 
                    (td.harga * td.qty) AS subtotal
                 FROM 
                    transaksi_detail td
                 JOIN 
                    barang b ON td.barang_id = b.id
                 WHERE 
                    td.transaksi_id = $id_transaksi";

$hasil_detail = $koneksi->query($query_detail);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Transaksi #<?php echo $id_transaksi; ?></title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <div class="container">
        <h2>Detail Transaksi #<?php echo htmlspecialchars($transaksi_data['id']); ?></h2>
        
        <div class="menu">
            <a href="index.php" class="btn">⬅ Kembali ke Daftar Transaksi</a> 
        </div>

        <div class="info-box" style="margin-bottom: 20px;">
            <p><strong>Waktu Transaksi:</strong> <?php echo htmlspecialchars($transaksi_data['waktu_transaksi']); ?></p>
            <p><strong>Pelanggan:</strong> <?php echo htmlspecialchars($transaksi_data['nama_pelanggan']); ?></p>
            <p><strong>Keterangan:</strong> <?php echo htmlspecialchars($transaksi_data['keterangan']); ?></p>
            <p><strong>Total Transaksi:</strong> Rp<?php echo number_format($transaksi_data['total'], 0, ',', '.'); ?></p>
        </div>

        <h3>Barang yang Dibeli</h3>
        <table>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($hasil_detail->num_rows > 0) {
                    while($detail_barang = $hasil_detail->fetch_assoc()) {
                        $harga_terformat = "Rp" . number_format($detail_barang['harga_satuan'], 0, ',', '.');
                        $subtotal_terformat = "Rp" . number_format($detail_barang['subtotal'], 0, ',', '.');
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($detail_barang['kode_barang']) . "</td>";
                        echo "<td>" . htmlspecialchars($detail_barang['nama_barang']) . "</td>";
                        echo "<td>" . htmlspecialchars($detail_barang['jumlah']) . "</td>";
                        echo "<td>" . $harga_terformat . "</td>";
                        echo "<td>" . $subtotal_terformat . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada detail barang.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>