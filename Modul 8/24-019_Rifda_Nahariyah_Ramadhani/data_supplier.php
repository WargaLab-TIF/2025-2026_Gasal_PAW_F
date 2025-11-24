<?php
include "koneksi.php";

$sql = "SELECT id, nama, alamat, telp
        FROM supplier
        ORDER BY id ASC"; 

$result_query = mysqli_query($koneksi, $sql);

if (!$result_query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
</head>
<body style="font-family: Arial, sans-serif;">

<table width="100%" bgcolor="black" cellpadding="10">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="dashboard.php" style="color:white; text-decoration:none;"><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>

<div align="center">
    <h1>DATA MASTER SUPPLIER</h1>
    
    <table border="1" cellpadding="8" width="70%" style="margin-top: 10px;">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">Nama Supplier</th>
                <th width="22%">Alamat</th>
                <th width="10%">Telepon</th>
                <th width="10%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result_query) > 0) {
            while ($d = mysqli_fetch_assoc($result_query)) {
                $id_supplier = htmlspecialchars($d['id']);

                echo "
                <tr style='text-align:center;'>
                    <td>{$id_supplier}</td>
                    <td align='left'>" . htmlspecialchars($d['nama']) . "</td>
                    <td align='left'>" . htmlspecialchars($d['alamat']) . "</td>
                    <td>" . htmlspecialchars($d['telp']) . "</td>
                    <td>
                        <a href='edit_supplier.php?id={$id_supplier}' 
                           style='background-color: orange; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px; margin-right: 5px;'>
                           <b>Edit</b>
                        </a>
                        
                        <a href='hapus_supplier.php?id={$id_supplier}' 
                           style='background-color: red; color: white; padding: 3px 6px; text-decoration: none; border-radius: 3px;' 
                           onclick=\"return confirm('Yakin ingin menghapus supplier {$id_supplier}?');\">
                           <b>Hapus</b>
                        </a>
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