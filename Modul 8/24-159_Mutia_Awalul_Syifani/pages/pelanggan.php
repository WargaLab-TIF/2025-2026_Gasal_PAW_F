<?php
include "../koneksi.php";

if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id='$_GET[hapus]'");
    header("Location: pelanggan.php");
}

if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO pelanggan(nama, jenis_kelamin, telp, alamat) VALUES(
        '$_POST[nama]','$_POST[jenis_kelamin]','$_POST[telp]','$_POST[alamat]')");
    header("Location: pelanggan.php");
}

if (isset($_POST['edit'])) {
    mysqli_query($conn, "UPDATE pelanggan SET 
        nama='$_POST[nama]',
        jenis_kelamin='$_POST[jenis_kelamin]',
        telp='$_POST[telp]'
        alamat='$_POST[alamat]',
        WHERE id='$_POST[id]'");
    header("Location: pelanggan.php");
}

$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $q = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$_GET[edit]'");
    $data_edit = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pelanggan</title>

<style>
    body { font-family: Arial; background: #f2f2f2; padding: 20px; }
    table { width: 70%; border-collapse: collapse; background: white; }
    th, td { border: 1px solid #666; padding: 10px; }
    .form-box { background: white; padding: 15px; margin-top: 20px; width: 350px; }
    input, textarea { width: 90%; padding: 8px; margin-bottom: 10px; }
    button { width: 50%; padding: 10px; background: #0056A6; color: white; border: none; cursor: pointer; }
</style>

</head>
<body>

<h2>Data Pelanggan</h2>
<a href="../index.php">Kembali</a><br><br>

<table>
<tr><th>ID</th><th>Nama</th><th>Jenis Kelamin</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr>

<?php
$q = mysqli_query($conn, "SELECT * FROM pelanggan");
while ($d = mysqli_fetch_assoc($q)) {
?>
<tr>
<td><?= $d['id'] ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['jenis_kelamin'] ?></td>
<td><?= $d['telp'] ?></td>
<td><?= $d['alamat'] ?></td>

<td>
<a href="?edit=<?= $d['id'] ?>">Edit</a> |
<a onclick="return confirm('Anda yakin ingin menghapus?')" href="?hapus=<?= $d['id'] ?>">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

<div class="form-box">
<h3><?= $edit_mode ? "Edit Pelanggan" : "Tambah Pelanggan" ?></h3>

<form method="POST">

<?php if ($edit_mode) { ?>
<input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
<?php } ?>

Nama:
<input type="text" name="nama" value="<?= $edit_mode ? $data_edit['nama'] : '' ?>">

Jenis Kelamin:
<input type="text" name="jk" value="<?= $edit_mode ? $data_edit['jenis_kelamin'] : '' ?>">

Telp:
<input type="text" name="telp" value="<?= $edit_mode ? $data_edit['telp'] : '' ?>">

Alamat:
<textarea name="alamat" rows="3"><?= $edit_mode ? $data_edit['alamat'] : '' ?></textarea>

<button name="<?= $edit_mode ? 'edit' : 'tambah' ?>">
<?= $edit_mode ? 'Update' : 'Simpan' ?>
</button>

</form>
</div>

</body>
</html>
