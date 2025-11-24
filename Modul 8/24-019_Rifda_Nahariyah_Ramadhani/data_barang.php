<?php
include "koneksi.php";

$sql = "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS nama_supplier
          FROM barang b
          LEFT JOIN supplier s ON b.supplier_id = s.id
          ORDER BY b.id ASC";
$result_query = mysqli_query($koneksi, $sql);

if (!$result_query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Barang</title>
</head>
<body style="font-family: Arial, sans-serif;">

<table  width="100%" bgcolor="black" cellpadding="10" cellspacing="0">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="dashboard.php" style="color:white; text-decoration:none; "><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>

<div align="center">
    <h1>DATA MASTER BARANG</h1>
    <table border="1" cellpadding="8" width="60%" style="margin-top: 10px;">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="10%">Kode Barang</th>
                <th width="20%">Nama Barang</th>
                <th width="10%">Harga</th>
                <th width="7%">Stok</th>
                <th width="20%">Nama Supplier</th>
                <th width="15%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result_query) > 0) {
            $nomor = 1;
            while ($d = mysqli_fetch_assoc($result_query)) {
                $id_barang = htmlspecialchars($d['id']);
                $nama_supplier = !empty($d['nama_supplier']) ? htmlspecialchars($d['nama_supplier']) : 'UMUM / -';

                echo "
                <tr style='text-align:center;'>
                    <td>{$d['id']}</td>
                    <td>" . htmlspecialchars($d['kode_barang']) . "</td>
                    <td align='left'>" . htmlspecialchars($d['nama_barang']) . "</td>
                    <td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>
                    <td>" . htmlspecialchars($d['stok']) . "</td>
                    <td  align='left'>{$nama_supplier}</td>
                    <td>
                        <a href='edit_barang.php?id={$id_barang}' 
                        style='background-color: orange; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px; margin-right: 5px;'>Edit</a>
                        
                        <a href='hapus_barang.php?id={$id_barang}' 
                        style='background-color: red; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px;' 
                        onclick=\"return confirm('Yakin ingin menghapus barang {$id_barang} - " . htmlspecialchars($d['nama_barang']) . "?');\">Hapus</a>
                    </td>
                </tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>