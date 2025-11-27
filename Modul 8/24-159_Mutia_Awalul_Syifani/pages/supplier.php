<?php
include "../koneksi.php";


if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM supplier WHERE id='$_GET[hapus]'");
    header("Location: supplier.php");
}


if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO supplier(nama, alamat, telp) VALUES(
        '$_POST[nama]','$_POST[alamat]','$_POST[telp]')");
    header("Location: supplier.php");
}

if (isset($_POST['edit'])) {
    mysqli_query($conn, "UPDATE supplier SET 
        nama='$_POST[nama]',
        alamat='$_POST[alamat]',
        telp='$_POST[telp]'
        WHERE id='$_POST[id]' ");
    header("Location: supplier.php");
}

$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $q = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$_GET[edit]'");
    $data_edit = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Supplier</title>

<style>
    body { font-family: Arial; padding: 20px; background: #f2f2f2; }
    table { border-collapse: collapse; width: 70%; background: white; }
    th, td { border: 1px solid #777; padding: 10px; }
    .form-box { margin-top: 20px; background: white; padding: 15px; width: 350px; border-radius: 5px; }
    input, textarea { width: 90%; padding: 8px; margin-bottom: 10px; }
    button { width: 50%; padding: 10px; background: #0056A6; color: white; border: none; cursor: pointer; }
</style>

</head>
<body>

<h2>Data Supplier</h2>
<a href="../index.php">Kembali</a>
<br><br>

<table>
<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>HP</th><th>Aksi</th></tr>

<?php
$q = mysqli_query($conn, "SELECT * FROM supplier");
while ($d = mysqli_fetch_assoc($q)) {
?>
<tr>
<td><?= $d['id'] ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['alamat'] ?></td>
<td><?= $d['telp'] ?></td>
<td>
<a href="?edit=<?= $d['id'] ?>">Edit</a> |
<a onclick="return confirm('Hapus?')" href="?hapus=<?= $d['id'] ?>">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

<div class="form-box">
<h3><?= $edit_mode ? "Edit Supplier" : "Tambah Supplier" ?></h3>

<form method="POST">

<?php if ($edit_mode) { ?>
<input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
<?php } ?>

Nama:
<input type="text" name="nama" value="<?= $edit_mode ? $data_edit['nama'] : '' ?>">

Alamat:
<textarea name="alamat" rows="3"><?= $edit_mode ? $data_edit['alamat'] : '' ?></textarea>

HP:
<input type="text" name="telp" value="<?= $edit_mode ? $data_edit['telp'] : '' ?>">

<button name="<?= $edit_mode ? 'edit' : 'tambah' ?>">
<?= $edit_mode ? 'Update' : 'Simpan' ?>
</button>

</form>
</div>

</body>
</html>
