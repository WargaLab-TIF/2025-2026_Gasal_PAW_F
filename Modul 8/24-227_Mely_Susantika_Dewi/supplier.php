<?php
require 'auth.php';
require 'koneksi.php';

$page = $_GET['page'] ?? 'list';

/* ============================
    SIMPAN
=============================*/
if ($page == 'simpan') {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat)
                            VALUES ('$nama', '$telp', '$alamat')");
    header("Location: supplier.php");
    exit;
}

/* ============================
    HAPUS
=============================*/
if ($page == 'hapus') {
    $id = (int)$_GET['id'];
    mysqli_query($koneksi, "DELETE FROM supplier WHERE id=$id");
    header("Location: supplier.php");
    exit;
}

/* ============================
    UPDATE
=============================*/
if ($page == 'update') {
    $id     = (int)$_GET['id'];
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_query($koneksi, "UPDATE supplier SET 
                nama='$nama',
                telp='$telp',
                alamat='$alamat'
            WHERE id=$id");

    header("Location: supplier.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Supplier</title>

<style>
/* ======================
   TABEL
=========================*/
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 10px;
    background: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

th {
    background: #2caa41ff;
    color: white;
    padding: 10px;
    text-align: center;
}

td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
    background: #f5faf6;
}

tr:hover {
    background: #e8f5ea;
}

/* ======================
   BUTTON
=========================*/
.btn {
    background: #2caa41ff;
    color: white;
    padding: 7px 14px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}
.btn:hover {
    opacity: 0.85;
}

/* ======================
   TOMBOL EDIT / HAPUS
=========================*/
.tbl-aksi a {
    display: inline-block;
    padding: 7px 14px;
    border-radius: 6px;
    margin: 2px;
    font-weight: bold;
    text-decoration: none;
    color: white !important;
}

/* Edit = Hijau */
.btn-edit {
    background: #28a745;
}
.btn-edit:hover {
    background: #1e7e34;
}

/* Hapus = Merah */
.btn-hapus {
    background: #d00000;
}
.btn-hapus:hover {
    background: #a00000;
}
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<?php if ($page == 'list'): ?>

<h2>Data Supplier</h2>
<a class="btn" href="supplier.php?page=tambah">Tambah Supplier</a>
<br><br>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Telp</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$q = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY id DESC");
while ($r = mysqli_fetch_assoc($q)) {
    echo "
    <tr>
        <td>$no</td>
        <td>{$r['nama']}</td>
        <td>{$r['telp']}</td>
        <td>{$r['alamat']}</td>
        <td class='tbl-aksi'>
            <a class='btn-edit' href='supplier.php?page=edit&id={$r['id']}'>Edit</a>
            <a class='btn-hapus' href='supplier.php?page=hapus&id={$r['id']}' onclick=\"return confirm('Hapus data ini?')\">Hapus</a>
        </td>
    </tr>";
    $no++;
}
?>
</table>

<?php elseif ($page == 'tambah'): ?>

<h2>Tambah Supplier</h2>

<form method="post" action="supplier.php?page=simpan">
    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Telp:<br>
    <input type="text" name="telp"><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    <button class="btn">Simpan</button>
</form>

<?php elseif ($page == 'edit'): ?>

<?php
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM supplier WHERE id=$id"));
?>

<h2>Edit Supplier</h2>

<form method="post" action="supplier.php?page=update&id=<?= $id; ?>">
    Nama:<br>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

    Telp:<br>
    <input type="text" name="telp" value="<?= $data['telp']; ?>"><br><br>

    Alamat:<br>
    <textarea name="alamat"><?= $data['alamat']; ?></textarea><br><br>

    <button class="btn">Update</button>
</form>

<?php endif; ?>

</body>
</html>
