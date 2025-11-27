<?php
include "../koneksi.php";

if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM barang WHERE id='$_GET[hapus]'");
    header("Location: barang.php");
}

if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO barang(nama_barang, harga, stok) VALUES (
        '$_POST[nama_barang]','$_POST[harga]','$_POST[stok]')");
    header("Location: barang.php");
}

if (isset($_POST['edit'])) {
    mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$_POST[nama_barang]',
        harga='$_POST[harga]',
        stok='$_POST[stok]'
        WHERE id='$_POST[id]' ");
    header("Location: barang.php");
}

$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $result = mysqli_query($conn, "SELECT * FROM barang WHERE id='$_GET[edit]'");
    $data_edit = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Barang</title>

<style>
    body { font-family: Arial; background: #f2f2f2; padding: 20px; }

    h2 { color: #0056A6; }

    table { border-collapse: collapse; width: 70%; background: white; }
    th, td { border: 1px solid #999; padding: 10px; }

    .form-box {
        margin-top: 20px;
        padding: 15px;
        width: 350px;
        background: white;
        border-radius: 5px;
    }

    input { width: 90%; padding: 8px; margin-bottom: 10px; }
    button {
        padding: 10px; 
        background: #0056A6;
        color: white;
        border: none; 
        cursor: pointer;
        width: 50%;
    }
</style>

</head>

<body>

<h2>Data Barang</h2>
<a href="../index.php">Kembali</a>
<br><br>

<table>
<tr>
    <th>ID</th> <th>Nama</th> <th>Harga</th> <th>Stok</th> <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
while ($d = mysqli_fetch_assoc($q)) {
?>
<tr>
    <td><?= $d['id'] ?></td>
    <td><?= $d['nama_barang'] ?></td>
    <td><?= $d['harga'] ?></td>
    <td><?= $d['stok'] ?></td>
    <td>
        <a href="?edit=<?= $d['id'] ?>">Edit</a> |
        <a onclick="return confirm('Hapus data?')" href="?hapus=<?= $d['id'] ?>">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<div class="form-box">
<h3><?= $edit_mode ? "Edit Barang" : "Tambah Barang" ?></h3>

<form method="POST">

<?php if ($edit_mode) { ?>
<input type="hidden" name="id" value="<?= $data_edit['id'] ?>">
<?php } ?>

Nama Barang:
<input type="text" name="nama_barang" value="<?= $edit_mode ? $data_edit['nama_barang'] : '' ?>" required>

Harga:
<input type="number" name="harga" value="<?= $edit_mode ? $data_edit['harga'] : '' ?>" required>

Stok:
<input type="number" name="stok" value="<?= $edit_mode ? $data_edit['stok'] : '' ?>" required>

<button type="submit" name="<?= $edit_mode ? 'edit' : 'tambah' ?>">
    <?= $edit_mode ? 'Update' : 'Simpan' ?>
</button>

</form>
</div>

</body>
</html>
