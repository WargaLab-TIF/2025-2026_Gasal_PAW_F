<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";


// HAPUS DATA 
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
    header("Location: data_barang.php");
    exit();
}


// SIMPAN BARANG BARU 
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier = $_POST['supplier_id'];

    mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
    VALUES ('$kode', '$nama', '$harga', '$stok', '$supplier')");

    header("Location: data_barang.php");
    exit();
}


// UPDATE BARANG 
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier = $_POST['supplier_id'];

    mysqli_query($conn, "UPDATE barang SET 
        kode_barang='$kode',
        nama_barang='$nama',
        harga='$harga',
        stok='$stok',
        supplier_id='$supplier'
        WHERE id='$id'
    ");

    header("Location: data_barang.php");
    exit();
}


// Jika klik tombol edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $q = mysqli_query($conn, "SELECT * FROM barang WHERE id='$id'");
    $editData = mysqli_fetch_assoc($q);
}


// TAMPILKAN SEMUA DATA
$data = mysqli_query($conn, "SELECT * FROM barang");
?>

<h2>Data Barang</h2>
<a href="home.php">Kembali</a>
<br><br>

<!-- FORM TAMBAH / EDIT -->
<?php if ($editData) { ?>
    <h3>Edit Barang</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">

        Kode Barang:<br>
        <input type="text" name="kode_barang" value="<?= $editData['kode_barang'] ?>"><br><br>

        Nama Barang:<br>
        <input type="text" name="nama_barang" value="<?= $editData['nama_barang'] ?>"><br><br>

        Harga:<br>
        <input type="number" name="harga" value="<?= $editData['harga'] ?>"><br><br>

        Stok:<br>
        <input type="number" name="stok" value="<?= $editData['stok'] ?>"><br><br>

        Supplier ID:<br>
        <input type="number" name="supplier_id" value="<?= $editData['supplier_id'] ?>"><br><br>

        <button type="submit" name="update">Update</button>
        <a href="data_barang.php">Batal</a>
    </form>

<?php } else { ?>

    <h3>Tambah Barang Baru</h3>
    <form method="POST">

        Kode Barang:<br>
        <input type="text" name="kode_barang"><br><br>

        Nama Barang:<br>
        <input type="text" name="nama_barang"><br><br>

        Harga:<br>
        <input type="number" name="harga"><br><br>

        Stok:<br>
        <input type="number" name="stok"><br><br>

        Supplier ID:<br>
        <input type="number" name="supplier_id"><br><br>

        <button type="submit" name="tambah">Simpan</button>
    </form>
<?php } ?>

<br><hr><br>


<!-- TABEL TAMPIL DATA -->
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Supplier</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['kode_barang'] ?></td>
        <td><?= $row['nama_barang'] ?></td>
        <td><?= number_format($row['harga']) ?></td>
        <td><?= $row['stok'] ?></td>
        <td><?= $row['supplier_id'] ?></td>
        <td>
            <a href="data_barang.php?edit=<?= $row['id'] ?>">Edit</a> |
            <a href="data_barang.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>
