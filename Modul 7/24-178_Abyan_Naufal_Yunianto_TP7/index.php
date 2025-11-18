<?php
// transaksi.php

include 'koneksi.php'; 

// Query untuk mengambil data transaksi utama
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
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Data Master Transaksi</h2>
        <div class="menu"> 
            <a href="report_transaksi.php" class="btn-tambah">Lihat Laporan Penjualan</a>
            <a href="tambah_transaksi.php" class="btn-tambah">Tambah Transaksi</a>
        </div>
        <br>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Waktu Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th colspan="2">Tindakan</th> </tr>
            </thead>
            <tbody>
                <?php 
                $nomor = 1;
                if ($hasil_transaksi->num_rows > 0) {
                    while($baris = $hasil_transaksi->fetch_assoc()) {
                        $total_terformat = "Rp" . number_format($baris['total'], 0, ',', '.');
                        echo "<tr>";
                        echo "<td>" . $nomor++ . "</td>";
                        echo "<td>" . htmlspecialchars($baris['id_transaksi']) . "</td>";
                        echo "<td>" . htmlspecialchars($baris['waktu_transaksi']) . "</td>";
                        echo "<td>" . htmlspecialchars($baris['nama_pelanggan']) . "</td>";
                        echo "<td>" . htmlspecialchars($baris['keterangan']) . "</td>";
                        echo "<td>" . $total_terformat . "</td>";
                        // Tombol Lihat Detail (menggunakan kelas .btn-detail)
                        echo "<td><a href='detail_transaksi.php?id=" . $baris['id_transaksi'] . "' class='btn-detail'>Lihat Detail</a></td>";
                        // Tombol Hapus (menggunakan kelas .btn-hapus)
                        echo "<td><a href='hapus_transaksi.php?id={$baris['id_transaksi']}' class='btn-hapus' onclick='return confirm(\"Yakin mau hapus?\")'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>