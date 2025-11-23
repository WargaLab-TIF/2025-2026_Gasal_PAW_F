<?php
require 'auth.php';
require 'koneksi.php';

$page = $_GET['page'] ?? 'list';

// ============================
// SIMPAN USER BARU
// ============================
if ($page == 'simpan') {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $hp       = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $level    = (int)$_POST['level'];

    mysqli_query($koneksi, "INSERT INTO user (username,password,nama,alamat,hp,level)
    VALUES ('$username','$password','$nama','$alamat','$hp',$level)");

    header("Location: user.php");
    exit;
}

// ============================
// HAPUS USER
// ============================
if ($page == 'hapus') {
    $id = (int)$_GET['id'];
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user=$id");
    header("Location: user.php");
    exit;
}

// ============================
// UPDATE USER
// ============================
if ($page == 'update') {

    $id       = (int)$_GET['id'];
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $hp       = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $level    = (int)$_POST['level'];

    mysqli_query($koneksi, "UPDATE user SET 
        username='$username',
        password='$password',
        nama='$nama',
        alamat='$alamat',
        hp='$hp',
        level=$level
        WHERE id_user=$id
    ");

    header("Location: user.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>

<style>
/* ======================
   STYLE TABEL
======================*/
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
   TOMBOL BIRU UTAMA
======================*/
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
   TOMBOL AKSI EDIT / HAPUS
======================*/
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

<h2>Data User</h2>

<?php if ($page == 'list'): ?>

<a class="btn" href="user.php?page=tambah">Tambah User</a>
<br><br>

<table>
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>HP</th>
    <th>Level</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$q = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user DESC");

while ($r = mysqli_fetch_assoc($q)):
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $r['username']; ?></td>
    <td><?= $r['nama']; ?></td>
    <td><?= $r['alamat']; ?></td>
    <td><?= $r['hp']; ?></td>
    <td><?= ($r['level'] == 1 ? 'Owner' : 'Kasir'); ?></td>

    <td class="tbl-aksi">
        <a class="btn-edit" href="user.php?page=edit&id=<?= $r['id_user']; ?>">Edit</a>
        <a class="btn-hapus" href="user.php?page=hapus&id=<?= $r['id_user']; ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php elseif ($page == 'tambah'): ?>

<h3>Tambah User</h3>

<form method="post" action="user.php?page=simpan">

    Username:<br>
    <input type="text" name="username" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Alamat:<br>
    <textarea name="alamat"></textarea><br><br>

    HP:<br>
    <input type="text" name="hp"><br><br>

    Level:<br>
    <select name="level">
        <option value="1">Owner</option>
        <option value="2">Kasir</option>
    </select><br><br>

    <button class="btn">Simpan</button>
</form>

<?php elseif ($page == 'edit'): ?>

<?php
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user=$id"));
?>

<h3>Edit User</h3>

<form method="post" action="user.php?page=update&id=<?= $id; ?>">

    Username:<br>
    <input type="text" name="username" value="<?= $data['username']; ?>" required><br><br>

    Password:<br>
    <input type="password" name="password" value="<?= $data['password']; ?>" required><br><br>

    Nama:<br>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>

    Alamat:<br>
    <textarea name="alamat"><?= $data['alamat']; ?></textarea><br><br>

    HP:<br>
    <input type="text" name="hp" value="<?= $data['hp']; ?>"><br><br>

    Level:<br>
    <select name="level">
        <option value="1" <?= ($data['level']==1?'selected':''); ?>>Owner</option>
        <option value="2" <?= ($data['level']==2?'selected':''); ?>>Kasir</option>
    </select><br><br>

    <button class="btn">Update</button>
</form>

<?php endif; ?>

</body>
</html>
