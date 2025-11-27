<?php
session_start();

// 1. CEK SECURITY: Jika belum login, tendang ke login
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}

include 'koneksi.php'; 

// Ambil Level untuk mengatur Sidebar
$level = $_SESSION['level'];

// Ambil ID Transaksi dari parameter URL
$id_transaksi = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_transaksi === 0) {
    echo "<script>alert('ID Transaksi tidak valid.'); window.location='transaksi.php';</script>";
    exit;
}

// 2. Ambil Data Transaksi Utama
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
    echo "<script>alert('Data transaksi tidak ditemukan.'); window.location='transaksi.php';</script>";
    exit;
}

// 3. Ambil Detail Barang yang Dibeli
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
        <br>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="content">
        <div class="card">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <h3>Detail Transaksi #<?php echo htmlspecialchars($transaksi_data['id']); ?></h3>
                <a href="transaksi.php" class="btn-kembali">⬅ Kembali</a> 
            </div>

            <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ddd;">
                <table style="width: auto; background: transparent; margin-top: 0;">
                    <tr>
                        <td style="border: none; padding: 5px 15px 5px 0; font-weight: bold;">Waktu Transaksi</td>
                        <td style="border: none; padding: 5px;">: <?php echo htmlspecialchars($transaksi_data['waktu_transaksi']); ?></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 5px 15px 5px 0; font-weight: bold;">Pelanggan</td>
                        <td style="border: none; padding: 5px;">: <?php echo htmlspecialchars($transaksi_data['nama_pelanggan']); ?></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 5px 15px 5px 0; font-weight: bold;">Keterangan</td>
                        <td style="border: none; padding: 5px;">: <?php echo htmlspecialchars($transaksi_data['keterangan']); ?></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 5px 15px 5px 0; font-weight: bold;">Total Transaksi</td>
                        <td style="border: none; padding: 5px; font-size: 1.1em; color: green; font-weight: bold;">: Rp <?php echo number_format($transaksi_data['total'], 0, ',', '.'); ?></td>
                    </tr>
                </table>
            </div>

            <h4 style="margin-bottom: 10px; color: #444;">Barang yang Dibeli</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
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
                            $harga_terformat = "Rp " . number_format($detail_barang['harga_satuan'], 0, ',', '.');
                            $subtotal_terformat = "Rp " . number_format($detail_barang['subtotal'], 0, ',', '.');
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($detail_barang['kode_barang']) . "</td>";
                            echo "<td>" . htmlspecialchars($detail_barang['nama_barang']) . "</td>";
                            echo "<td>" . htmlspecialchars($detail_barang['jumlah']) . "</td>";
                            echo "<td>" . $harga_terformat . "</td>";
                            echo "<td>" . $subtotal_terformat . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada detail barang.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>