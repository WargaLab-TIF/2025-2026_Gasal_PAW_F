<?php
include "koneksi.php";

$sql = "SELECT t.id, t.waktu_transaksi, p.nama, t.keterangan, t.total
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.id = p.id
        ORDER BY t.waktu_transaksi ASC, t.id ASC"; 

$result_query = mysqli_query($conn, $sql);

if (!$result_query) {
    die("Query gagal: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .container { max-width: 1100px; margin: 20px auto; padding: 0 10px; }

        .navbar { background-color: #333; color: white; padding: 10px 0; }
        .navbar-container { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 10px; }
        .navbar-brand { font-weight: bold; font-size: 20px; text-decoration: none; color: white; }
        .nav-list a { color: white; text-decoration: none; margin-left: 15px; }

        .card { background-color: white; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .card-header { background-color: blue; color: white; padding: 15px; font-size: 1.2em; font-weight: bold; border-radius: 8px 8px 0 0; }
        .card-body { padding: 20px; }
        
        .action-area { display: flex; justify-content: flex-end; margin-bottom: 20px; gap: 10px; }
        .btn { padding: 8px 12px; text-decoration: none; color: white; border: none; border-radius: 4px; cursor: pointer; display: inline-block; font-size: 14px; }
        .btn-primary { background-color: blue; }
        .btn-success { background-color: limegreen; }
        .btn-info { background-color: DeepSkyBlue; margin-right: 5px; }
        .btn-danger { background-color: red; }

        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 10px; border: 1px solid #dee2e6; text-align: left; }
        .table th { background-color: #e9ecef; }
        .action-btns a { margin-right: 5px; }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-container">
        <a class="navbar-brand">DATA MASTER</a>
        <div class="nav-list">
            <a href="">Supplier</a>
            <a href="">Barang</a>
            <a href="master_transaksi.php">Transaksi</a>
        </div>
    </div>
</div>
    
<div class="container">
    <div class="card">
        <div class="card-header">Data Master Transaksi</div>
        
        <div class="card-body">
            <div class="action-area">
                <a href="report_transaksi.php" class="btn btn-primary" role="button">Lihat Laporan Penjualan</a>
                <a href="tambah_transaksi.php" class="btn btn-success" role="button">Tambah Transaksi</a>
            </div>
            
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        if (mysqli_num_rows($result_query) > 0) {
                            while($row = mysqli_fetch_assoc($result_query)){
                                $transaksi_id = htmlspecialchars($row['id']); 
                                $total_rupiah = "Rp" . number_format($row['total'], 0, ',', '.');
                                $nama_pelanggan = $row['nama'] ? htmlspecialchars($row['nama']) : 'Umum';

                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $transaksi_id . "</td>";
                                echo "<td>" . htmlspecialchars($row['waktu_transaksi']) . "</td>";
                                echo "<td>" . $nama_pelanggan . "</td>";
                                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                echo "<td style='text-align: right;'>" . $total_rupiah . "</td>";
                                
                                echo "<td class='action-btns'>";
                                echo "<a href='detail_transaksi.php?id=" . $transaksi_id . "' class='btn btn-info'>Lihat Detail</a>";
                                echo "<a href='hapus_transaksi.php?id=" . $transaksi_id . "' 
                                class='btn btn-danger' onclick=\"return confirm('Yakin hapus transaksi ID: " . $transaksi_id . "?')\">Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data transaksi.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>