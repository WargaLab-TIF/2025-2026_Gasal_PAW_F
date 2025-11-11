<?php
include 'koneksi.php';

function updateTotalTransaksi($koneksi, $transaksi_id) {
    $sql_hitung_total = "SELECT SUM(b.harga * td.qty) AS total_baru
        FROM transaksi_detail td
        JOIN barang b ON td.barang_id = b.id
        WHERE td.transaksi_id = $transaksi_id";
    
    $result_hitung = $koneksi->query($sql_hitung_total);
    if ($result_hitung === false) { 
        return false; 
    } 

    $row = $result_hitung->fetch_assoc();
    $total_baru = $row['total_baru'] ?? 0;
    $sql_update_total = "UPDATE transaksi 
        SET total = $total_baru 
        WHERE id = $transaksi_id";
    
    $success = $koneksi->query($sql_update_total);
    return $success;
}
?>

<!DOCTYPE html>
<html lang="id">
<head style="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Data Master & Transaksi</title>
    <style>
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th, td { border: 1px solid black; padding: 10px; text-align: left; font-size: 14px; }
    </style>
</head>
<body style="font-family: Arial; background-color: white;  ">

<div class="container">
    <h1 style="text-align: center;">Pengelolaan Master Detail</h1>


    <h2>Barang</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Supplier</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_barang = "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS nama_supplier
            FROM barang b
            LEFT JOIN supplier s ON b.supplier_id = s.id
            ORDER BY b.id ASC";
            
            $result_barang = $koneksi->query($query_barang);
            
            if ($result_barang && $result_barang->num_rows > 0) {
                while($b = $result_barang->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$b['id']}</td>";
                    echo "<td>{$b['kode_barang']}</td>";
                    echo "<td>{$b['nama_barang']}</td>";
                    echo "<td>Rp " . number_format($b['harga'], 0, ',', '.') . "</td>";
                    echo "<td>{$b['stok']}</td>";
                    echo "<td>{$b['nama_supplier']}</td>";
                    echo "<td><a href='hapus_barang.php?id={$b['id']}' 
                           onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\")' 
                           style='color: white; background-color: red; padding: 6px 10px; border-radius: 5px; text-decoration: none;'>Delete</a></td>"; 
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align: center;'>Tidak ada data barang.</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <h2>Transaksi</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th> </tr>
        </thead>
        <tbody>
            <?php
            $query_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan
                FROM transaksi t
                LEFT JOIN pelanggan p ON t.pelanggan_id = p.id  
                ORDER BY t.id ASC";
                
            $result_transaksi = $koneksi->query($query_transaksi);
            
            if ($result_transaksi && $result_transaksi->num_rows > 0) {
                while($t = $result_transaksi->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$t['id']}</td>";
                    echo "<td>" . date('Y-m-d H:i', strtotime($t['waktu_transaksi'])) . "</td>";
                    echo "<td>{$t['keterangan']}</td>";
                    echo "<td>Rp " . number_format($t['total'], 0, ',', '.') . "</td>";
                    echo "<td>{$t['nama_pelanggan']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align: center;'>Tidak ada data transaksi.</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <h2>Transaksi Detail</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_detail = "SELECT td.transaksi_id, td.qty, b.nama_barang, b.harga
                FROM transaksi_detail td
                JOIN barang b ON td.barang_id = b.id
                ORDER BY td.transaksi_id DESC";

            $result_detail = $koneksi->query($query_detail);
            
            if ($result_detail && $result_detail->num_rows > 0) {
                while($d = $result_detail->fetch_assoc()) {
                    $sub_total = $d['harga'] * $d['qty'];
                    echo "<tr>";
                    echo "<td>{$d['transaksi_id']}</td>";
                    echo "<td>{$d['nama_barang']}</td>";
                    echo "<td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>";
                    echo "<td>{$d['qty']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align: center;'>Tidak ada detail transaksi.</td></tr>";
            }
            ?>
        </tbody>
    </table><br><br>
        <a href="form_transaksi.php" style="padding: 10px 18px; background-color: blue; color: white;  border-radius: 5px; text-decoration: none;"><b>Tambah Transaksi</b></a>
        <a href="detail_transaksi.php" style="padding: 10px 18px; background-color: blue; color: white;  border-radius: 5px; text-decoration: none;"><b>Tambah Transaksi Detail</b></a>
</div>

</body>
</html>
<?php
$koneksi->close();
?>