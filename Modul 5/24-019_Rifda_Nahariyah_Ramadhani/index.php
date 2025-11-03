<?php
include "koneksi.php";

$sql = "SELECT * FROM supplier";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
</head>
<body style="padding: 10px;">
    <h2 style="font-family: Arial;">Data Master Supplier</h2>
    <table border="1">
        <tr style="background-color: #e3ecfbff;">
            <th style="width: 5%; padding: 10px; font-family: Arial; border: 1px solid black">No</th>
            <th style="width: 30%; padding: 10px; font-family: Arial; border: 1px solid black">Nama</th>
            <th style="width: 15%; padding: 10px; font-family: Arial; border: 1px solid black">Telp</th>
            <th style="width: 30%; padding: 10px; font-family: Arial; border: 1px solid black">Alamat</th>
            <th style="width: 20%; padding: 10px; font-family: Arial; border: 1px solid black">Tindakan</th>
        </tr>
        <?php 
            if (!empty($result)) {
                $counter = 1;
                foreach($result as $row){
                    $supplier_id = htmlspecialchars($row['id']); 
                    
                    echo "<tr>";
                    echo "<td style='padding: 10px; font-family: Arial; border: 1px solid black; text-align: center;'>" . $counter++ . "</td>";
                    echo "<td style='padding: 10px; font-family: Arial; border: 1px solid black;'>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td style='padding: 10px; font-family: Arial; border: 1px solid black;'>" . htmlspecialchars($row['telp']) . "</td>";
                    echo "<td style='padding: 10px; font-family: Arial; border: 1px solid black;'>" . htmlspecialchars($row['alamat']) . "</td>";
                    echo "<td style='padding: 5px; font-family: Arial; border: 1px solid black; text-align: center; white-space: nowrap;'>";
                    
                    echo "<a href='update.php?no=" . $supplier_id . "' 
                    style='background-color: orange; color: white; padding: 5px 10px; border-radius: 3px; cursor: pointer; text-decoration: none; border: none; margin-right: 5px; display: inline-block;'><b>Edit</b></a>";
                    
                    echo "<a href='delete.php?no=" . $supplier_id . "' 
                    style='background-color: red; color: white; padding: 5px 10px; border-radius: 3px; cursor: pointer; 
                    text-decoration: none; border: none; display: inline-block;' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\"><b>Hapus</b></a>";
                    
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='padding: 10px; border: 1px solid black; text-align: center;'>Tidak ada data supplier.</td></tr>";
            }
            ?>
    </table><br>
    <a href="create.php" 
    style="background-color: limegreen; color: white; font-family: Arial; float: left; padding: 7px 10px; border-radius: 3px; cursor: pointer; text-decoration: none; ">
    <b>Tambah Data</b></a>
</body>
</html>