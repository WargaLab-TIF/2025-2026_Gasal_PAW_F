<?php
require 'auth.php';
require 'koneksi.php';

$page = $_GET['page'] ?? 'list';

/* --------------------- SIMPAN BARANG --------------------- */
if ($page == 'simpan') {
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga = (int)$_POST['harga'];
    $stok  = (int)$_POST['stok'];

    $supplier_id = ($_POST['supplier_id'] === '') ? "NULL" : (int)$_POST['supplier_id'];

    mysqli_query($koneksi, "INSERT INTO barang (kode_barang,nama_barang,harga,stok,supplier_id)
                            VALUES ('$kode','$nama',$harga,$stok,$supplier_id)");

    header("Location: barang.php");
    exit;
}

/* --------------------- HAPUS BARANG ---------------------- */
if ($page == 'hapus') {
    $id = (int)$_GET['id'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id=$id");
    header("Location: barang.php");
    exit;
}

/* --------------------- UPDATE BARANG ---------------------- */
if ($page == 'update') {
    $id = (int)$_GET['id'];
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga = (int)$_POST['harga'];
    $stok  = (int)$_POST['stok'];

    $supplier_id = ($_POST['supplier_id'] === '') ? "NULL" : (int)$_POST['supplier_id'];

    mysqli_query($koneksi, "UPDATE barang SET 
                            kode_barang='$kode',
                            nama_barang='$nama',
                            harga=$harga,
                            stok=$stok,
                            supplier_id=$supplier_id
                            WHERE id=$id");
    header("Location: barang.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Barang</title>

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
    font-size: 14px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
    background: #e8f9ed;
}

tr:hover {
    background: #d8f5e1;
}

/* ------------------ TOMBOL TAMBAH BARANG ------------------ */
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

.btn-edit {
    background: #2caa41ff;
}

.btn-hapus {
    background: #cc0000;
}

.aksi-btn:hover {
    opacity: .8;
}
</style>

</head>
<body>

<?php include 'navbar.php'; ?>


<?php if ($page == 'list'): ?>

<h2>Data Barang</h2>

<a href="barang.php?page=tambah" class="btn-tambah">+ Tambah Barang</a>

<table>
<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Supplier</th>
    <th>Aksi</th>
</tr>

<?php
$no=1;
$q = mysqli_query($koneksi, "SELECT b.*, s.nama AS supplier_nama 
                             FROM barang b 
                             LEFT JOIN supplier s ON b.supplier_id=s.id");
while ($r = mysqli_fetch_assoc($q)) {
    $sup = $r['supplier_nama'] ?: '-';

    echo "<tr>
        <td>{$no}</td>
        <td>{$r['kode_barang']}</td>
        <td>{$r['nama_barang']}</td>
        <td>{$r['harga']}</td>
        <td>{$r['stok']}</td>
        <td>{$sup}</td>
        <td>
            <a class='aksi-btn btn-edit' href='barang.php?page=edit&id={$r['id']}'>Edit</a>
            <a class='aksi-btn btn-hapus' href='barang.php?page=hapus&id={$r['id']}' onclick=\"return confirm('Hapus?')\">Hapus</a>
        </td>
    </tr>";

    $no++;
}
?>
</table>


<?php elseif ($page == 'tambah'): ?>

<?php $sup_list = mysqli_query($koneksi, "SELECT id,nama FROM supplier"); ?>

<h2>Tambah Barang</h2>

<form method="post" action="barang.php?page=simpan">
Kode: <input type="text" name="kode_barang" required><br><br>
Nama: <input type="text" name="nama_barang" required><br><br>
Harga: <input type="number" name="harga" required><br><br>
Stok: <input type="number" name="stok" required><br><br>

Supplier:
<select name="supplier_id">
    <option value="">-- Pilih --</option>
    <?php while($s=mysqli_fetch_assoc($sup_list)){ ?>
        <option value="<?= $s['id']; ?>"><?= htmlspecialchars($s['nama']); ?></option>
    <?php } ?>
</select>
<br><br>

<button>Simpan</button>
</form>


<?php elseif ($page == 'edit'): ?>

<?php
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM barang WHERE id=$id"));
$sup_list = mysqli_query($koneksi,"SELECT id,nama FROM supplier");
?>

<h2>Edit Barang</h2>

<form method="post" action="barang.php?page=update&id=<?= $id; ?>">
Kode: <input type="text" name="kode_barang" value="<?= htmlspecialchars($data['kode_barang']); ?>" required><br><br>
Nama: <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']); ?>" required><br><br>
Harga: <input type="number" name="harga" value="<?= $data['harga']; ?>" required><br><br>
Stok: <input type="number" name="stok" value="<?= $data['stok']; ?>" required><br><br>

Supplier:
<select name="supplier_id">
    <option value="">-- Pilih --</option>
    <?php while($s = mysqli_fetch_assoc($sup_list)){ ?>
        <option value="<?= $s['id']; ?>" <?= ($s['id'] == $data['supplier_id'] ? 'selected' : ''); ?>>
            <?= htmlspecialchars($s['nama']); ?>
        </option>
    <?php } ?>
</select>
<br><br>

<button>Update</button>
</form>

<?php endif; ?>


</body>
</html>
