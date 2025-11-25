<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'");
$d = mysqli_fetch_assoc($data);
?>

<h2>Edit Pelanggan</h2>

<form action="pelanggan_edit_proses.php" method="post">
    
    <input type="hidden" name="id" value="<?= $d['id']; ?>">

    Nama <br>
    <input type="text" name="nama" value="<?= $d['nama']; ?>" required><br><br>

    Jenis Kelamin <br>
    <select name="jenis_kelamin">
        <option value="L" <?= $d['jenis_kelamin']=='L'?'selected':''; ?>>Laki-laki</option>
        <option value="P" <?= $d['jenis_kelamin']=='P'?'selected':''; ?>>Perempuan</option>
    </select><br><br>

    Telepon <br>
    <input type="text" name="telp" value="<?= $d['telp']; ?>" required><br><br>

    Alamat <br>
    <textarea name="alamat" required><?= $d['alamat']; ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

<a href="pelanggan.php">Kembali</a>
