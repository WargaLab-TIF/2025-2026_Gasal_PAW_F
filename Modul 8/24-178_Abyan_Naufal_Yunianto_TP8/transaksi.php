<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}
include 'koneksi.php'; 

$level = $_SESSION['level'];

$query_transaksi = "SELECT 
            t.id AS id_transaksi, 
            t.waktu_transaksi, 
            p.nama AS nama_pelanggan, 
            t.keterangan, 
            t.total 
          FROM 
            transaksi t
          JOIN 
            pelanggan p ON t.pelanggan_id = p.id
          ORDER BY 
            t.waktu_transaksi DESC";

$hasil_transaksi = $koneksi->query($query_transaksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Transaksi</title>
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
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h3>Daftar Transaksi</h3>
                <div>
                    <a href="tambah_transaksi.php" class="btn-tambah">+ Tambah Transaksi</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomor = 1;
                    if ($hasil_transaksi->num_rows > 0) {
                        while($baris = $hasil_transaksi->fetch_assoc()) {
                            $total_terformat = "Rp " . number_format($baris['total'], 0, ',', '.');
                            echo "<tr>";
                            echo "<td>" . $nomor++ . "</td>";
                            echo "<td>" . htmlspecialchars($baris['waktu_transaksi']) . "</td>";
                            echo "<td>" . htmlspecialchars($baris['nama_pelanggan']) . "</td>";
                            echo "<td>" . htmlspecialchars($baris['keterangan']) . "</td>";
                            echo "<td>" . $total_terformat . "</td>";
                            echo "<td>";
                            echo "<a href='detail_transaksi.php?id=" . $baris['id_transaksi'] . "' class='btn-detail'>Detail</a> ";
                            echo "<a href='hapus_transaksi.php?id={$baris['id_transaksi']}' class='btn-hapus' onclick='return confirm(\"Yakin mau hapus?\")'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data transaksi.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>