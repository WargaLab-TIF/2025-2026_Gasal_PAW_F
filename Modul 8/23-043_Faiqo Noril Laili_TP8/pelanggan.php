<?php 

include 'koneksi.php'; 
?>

<h2>Data Pelanggan</h2>
<link rel="stylesheet" href="style.css">
<a href="pelanggan_tambah.php">+ Tambah Pelanggan</a>
<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php 
    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
    while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
        <td><?= $d['id']; ?></td>
        <td><?= $d['nama']; ?></td>
        <td><?= $d['jenis_kelamin']; ?></td>
        <td><?= $d['telp']; ?></td>
        <td><?= $d['alamat']; ?></td>
        <td>
            <a href="pelanggan_edit.php?id=<?= $d['id']; ?>">Edit</a>
            |
            <a href="pelanggan_hapus.php?id=<?= $d['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
