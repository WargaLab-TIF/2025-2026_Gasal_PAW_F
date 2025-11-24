<?php
include "../koneksi.php";


if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM user WHERE id_user='$_GET[hapus]'");
    header("Location: user.php");
}

if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO user(username,password,nama,level) VALUES(
        '$_POST[username]','$_POST[password]','$_POST[nama]','$_POST[level]')");
    header("Location: user.php");
}

if (isset($_POST['edit'])) {
    mysqli_query($conn, "UPDATE user SET 
        username='$_POST[username]',
        password='$_POST[password]',
        nama='$_POST[nama]',
        level='$_POST[level]'
        WHERE id_user='$_POST[id_user]'");
    header("Location: user.php");
}

$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $q = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$_GET[edit]'");
    $data_edit = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data User</title>

<style>
    body { font-family: Arial; background: #f2f2f2; padding: 20px; }
    table { border-collapse: collapse; background: white; width: 80%; }
    th, td { border: 1px solid #666; padding: 10px; }
    .form-box { background: white; padding: 15px; width: 350px; margin-top: 20px; }
    input, select { width: 90%; padding: 8px; margin-bottom: 10px; }
    button { width: 50%; padding: 10px; background: #0056A6; color: white; border: none; cursor: pointer; }
</style>

</head>

<body>

<h2>Data User</h2>
<a href="../index.php">Kembali</a><br><br>

<table>
<tr>
    <th>ID</th><th>Username</th><th>Password</th><th>Nama</th><th>Level</th><th>Aksi</th>
</tr>

<?php
$q = mysqli_query($conn, "SELECT * FROM user");
while ($d = mysqli_fetch_assoc($q)) {
?>
<tr>
<td><?= $d['id_user'] ?></td>
<td><?= $d['username'] ?></td>
<td><?= $d['password'] ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['level'] ?></td>
<td>
<a href="?edit=<?= $d['id_user'] ?>">Edit</a> |
<a onclick="return confirm('Anda yakin ingin menghapus?')" href="?hapus=<?= $d['id_user'] ?>">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

<div class="form-box">
<h3><?= $edit_mode ? "Edit User" : "Tambah User" ?></h3>

<form method="POST">

<?php if ($edit_mode) { ?>
<input type="hidden" name="id_user" value="<?= $data_edit['id_user'] ?>">
<?php } ?>

Username:
<input type="text" name="username" value="<?= $edit_mode ? $data_edit['username'] : '' ?>">

Password:
<input type="text" name="password" value="<?= $edit_mode ? $data_edit['password'] : '' ?>">

Nama:
<input type="text" name="nama" value="<?= $edit_mode ? $data_edit['nama'] : '' ?>">

Level:
<select name="level">
    <option value="1" <?= $edit_mode && $data_edit['level']==1 ? 'selected' : '' ?>>1 - Owner</option>
    <option value="2" <?= $edit_mode && $data_edit['level']==2 ? 'selected' : '' ?>>2 - Kasir</option>
</select>

<button name="<?= $edit_mode ? 'edit' : 'tambah' ?>">
<?= $edit_mode ? 'Update' : 'Simpan' ?>
</button>

</form>
</div>

</body>
</html>
