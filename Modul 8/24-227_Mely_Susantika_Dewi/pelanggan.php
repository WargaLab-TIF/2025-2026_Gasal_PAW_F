<?php
require 'auth.php';
require 'koneksi.php';

$page = $_GET['page'] ?? 'list';

/* ------------------- SIMPAN ------------------- */
if ($page == 'simpan') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jk = $_POST['jk'];
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_query($koneksi, "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat)
                            VALUES ('$nama', '$jk', '$telp', '$alamat')");
    header("Location: pelanggan.php");
    exit;
}

/* ------------------- HAPUS ------------------- */
if ($page == 'hapus') {
    $id = (int)$_GET['id'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id=$id");
    header("Location: pelanggan.php");
    exit;
}

/* ------------------- UPDATE ------------------- */
if ($page == 'update') {
    $id = (int)$_GET['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jk = $_POST['jk'];
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_query($koneksi, "UPDATE pelanggan SET 
                            nama='$nama',
                            jenis_kelamin='$jk',
                            telp='$telp',
                            alamat='$alamat'
                            WHERE id=$id");
    header("Location: pelanggan.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Pelanggan</title>

<style>
/* ------------------ STYLE TABEL ------------------ */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
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
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

tr:nth-child(even) { background: #e8f9ed; }
tr:hover { background: #d8f5e1; }

/* ------------------ TOMBOL TAMBAH ------------------ */
.btn-tambah {
    display: inline-block;
    padding: 8px 14px;
    background: #2caa41ff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

/* ------------------ TOMBOL AKSI ------------------ */
.aksi-btn {
    padding: 6px 12px;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    font-size: 13px;
}

.btn-edit { background: #2caa41ff; }
.btn-hapus { background: #cc0000; }

.aksi-btn:hover { opacity: .8; }
</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<?php if ($page == 'list'): ?>

<h2>Data Pelanggan</h2>

<a href="pelanggan.php?page=tambah" class="btn-tambah">+ Tambah Pelanggan</a>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>JK</th>
    <th>Telp</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$q = mysqli_query($koneksi, "SELECT * FROM pelanggan");
while ($r = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>{$no}</td>
        <td>{$r['nama']}</td>
        <td>{$r['jenis_kelamin']}</td>
        <td>{$r['telp']}</td>
        <td>{$r['alamat']}</td>
        <td>
            <a class='aksi-btn btn-edit' href='pelanggan.php?page=edit&id={$r['id']}'>Edit</a>
            <a class='aksi-btn btn-hapus' href='pelanggan.php?page=hapus&id={$r['id']}' onclick=\"return confirm('Hapus?')\">Hapus</a>
        </td>
    </tr>";
    $no++;
}
?>
</table>


<?php elseif ($page == 'tambah'): ?>

<h2>Tambah Pelanggan</h2>

<form method="post" action="pelanggan.php?page=simpan">
Nama: <input type="text" name="nama" required><br><br>

JK:
<select name="jk">
    <option value="L">L</option>
    <option value="P">P</option>
</select><br><br>

Telp: <input type="text" name="telp"><br><br>
Alamat: <textarea name="alamat"></textarea><br><br>

<button>Simpan</button>
</form>


<?php elseif ($page == 'edit'): ?>

<?php
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id=$id"));
?>

<h2>Edit Pelanggan</h2>

<form method="post" action="pelanggan.php?page=update&id=<?= $id; ?>">
Nama:
<input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required><br><br>

JK:
<select name="jk">
    <option value="L" <?= ($data['jenis_kelamin']=='L'?'selected':''); ?>>L</option>
    <option value="P" <?= ($data['jenis_kelamin']=='P'?'selected':''); ?>>P</option>
</select><br><br>

Telp: <input type="text" name="telp" value="<?= $data['telp']; ?>"><br><br>
Alamat: <textarea name="alamat"><?= $data['alamat']; ?></textarea><br><br>

<button>Update</button>
</form>

<?php endif; ?>

</body>
</html>
