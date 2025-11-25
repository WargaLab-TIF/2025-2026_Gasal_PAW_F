<?php include 'koneksi.php'; ?>
<link rel="stylesheet" href="style.css">

<h2>Data Barang</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th colspan="2">Aksi</th>
    </tr>

    <?php
    $data = mysqli_query($koneksi, "SELECT *FROM barang");
    while ($d = mysqli_fetch_array($data)){
        echo "<tr>
                <td>$d[id]</td>
                <td>$d[nama_barang]</td>
                <td>$d[harga]</td>
                <td>$d[stok]</td>
                <td><a href='barang_tambah.php?id=$d[id]'>Tambah</a></td>
                <td><a href='barang_hapus.php?id=$d[id]' onclick='return confirm(\"Yakin hapus?\")'>hapus</a></td>
               </tr>"; 
    }       
    ?>
</table>