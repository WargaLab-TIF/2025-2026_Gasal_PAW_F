<?php
    include "koneksi.php";

    // Ambil data Transaksi (Master)
    $sql_transaksi = "SELECT t.*, p.nama AS nama_pelanggan 
                      FROM transaksi t 
                      JOIN pelanggan p ON t.pelanggan_id = p.id 
                      ORDER BY t.id ASC";
    
    $query_transaksi = mysqli_query($conn, $sql_transaksi);
    $result_transaksi = mysqli_fetch_all($query_transaksi, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi Penjualan</title>
    <link rel="stylesheet" href="css/indexStyle.css">
</head>
<body>

    <h1>Sistem Penjualan</h1>

    <div class="header-container">
        <h2>Daftar Transaksi</h2>
        
        <div class="button-group">
            <button type="button" class="btn-laporan" onclick="window.location.href='report_transaksi.php'">
                Lihat Laporan Penjualan
            </button>

            <button type="button" class="btn-tambah" onclick="window.location.href='tambah_transaksi.php'">
                Tambah Transaksi Baru
            </button>
        </div>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu</th>
                <th>Pelanggan</th>
                <th>Keterangan</th>
                <th>Total Belanja</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (!empty($result_transaksi)): 
                foreach ($result_transaksi as $row): 
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>#<?= $row['id'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['waktu_transaksi'])) ?></td>
                    <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    
                    <td style="text-align: center;">
                        <button type="button" class="btn-detail" 
                                onclick="window.location.href='detail.php?id=<?= $row['id'] ?>'">
                            Lihat Detail
                        </button>

                        <button type="button" class="btn-hapus" 
                                onclick="if(confirm('Yakin ingin menghapus transaksi #<?= $row['id'] ?>?')) { window.location.href='hapus.php?tipe=transaksi&id=<?= $row['id'] ?>'; }">
                            Hapus
                        </button>
                    </td>

                </tr>
            <?php 
                endforeach; 
            else:
            ?>
                <tr>
                    <td colspan="7" style="text-align:center;">Belum ada data transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>