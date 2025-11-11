<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>
<body style="font-family: Arial;">

<div style="max-width: 1000px; margin: 50px auto; background: white; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 25px;">
    <h2 style="text-align: center; color: black; margin-bottom: 20px;">Daftar Barang</h2>

    <table border="1" cellpadding="8" width="100%" >
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
        $query = "
            SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS nama_supplier
            FROM barang b
            LEFT JOIN supplier s ON b.supplier_id = s.id
            ORDER BY b.id ASC
        ";
        $data = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($data) > 0) {
            while ($d = mysqli_fetch_assoc($data)) {
                echo "
                <tr style='text-align:center;'>
                    <td>{$d['id']}</td>
                    <td>{$d['kode_barang']}</td>
                    <td>{$d['nama_barang']}</td>
                    <td>Rp " . number_format($d['harga'], 0, ',', '.') . "</td>
                    <td>{$d['stok']}</td>
                    <td>" . (!empty($d['nama_supplier']) ? $d['nama_supplier'] : '-') . "</td>
                    <td>
                        <a href='hapus_barang.php?id={$d['id']}' 
                           onclick='return confirm(\"Apakah anda yakin ingin menghapus data ini?\")' 
                           style='color: white; background-color: red; padding: 6px 10px; border-radius: 5px; text-decoration: none;'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7' style='text-align:center;'>Belum ada data barang.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
