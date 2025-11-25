<?php
include "conn.php";
include "cek_session.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #333; color: white; }
    </style>
</head>
<body>
    <a href="admin.php">Kembali ke Dashboard</a>
    <h2>Laporan Penjualan</h2>
    
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            $query = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama as nama_pel 
                                          FROM transaksi 
                                          JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id");
            
            while($row = mysqli_fetch_assoc($query)){
                $grand_total += $row['total'];
                echo "<tr>
                    <td>$row[waktu_transaksi]</td>
                    <td>$row[nama_pel]</td>
                    <td>Rp " . number_format($row['total']) . "</td>
                </tr>";
            }
            ?>
            <tr>
                <th colspan="2" style="text-align:right">Total Keseluruhan</th>
                <th>Rp <?php echo number_format($grand_total); ?></th>
            </tr>
        </tbody>
    </table>
</body>
</html>