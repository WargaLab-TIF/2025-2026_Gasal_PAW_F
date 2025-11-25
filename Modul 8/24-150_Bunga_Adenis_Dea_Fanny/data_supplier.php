<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";


//  HAPUS DATA 
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");
    header("Location: data_supplier.php");
    exit();
}


//  TAMBAH DATA 
if (isset($_POST['tambah'])) {

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat)
                         VALUES ('$nama', '$telp', '$alamat')");

    header("Location: data_supplier.php");
    exit();
}


//  UPDATE DATA 
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "UPDATE supplier SET
        nama='$nama',
        telp='$telp',
        alamat='$alamat'
        WHERE id='$id'
    ");

    header("Location: data_supplier.php");
    exit();
}


//  MENGAMBIL DATA EDIT 
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $q = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
    $editData = mysqli_fetch_assoc($q);
}


//  TAMPIL DATA 
$data = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");
?>

<h2>Data Supplier</h2>
<a href="home.php">Kembali</a>
<br><br>


<!--  FORM EDIT / TAMBAH  -->

<?php if ($editData) { ?>
    <h3>Edit Supplier</h3>
    <form method="POST">

        <input type="hidden" name="id" value="<?= $editData['id'] ?>">

        Nama Supplier:<br>
        <input type="text" name="nama" value="<?= $editData['nama'] ?>"><br><br>

        Telp:<br>
        <input type="text" name="telp" value="<?= $editData['telp'] ?>"><br><br>

        Alamat:<br>
        <textarea name="alamat"><?= $editData['alamat'] ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
        <a href="data_supplier.php">Batal</a>

    </form>

<?php } else { ?>

    <h3>Tambah Supplier Baru</h3>
    <form method="POST">

        Nama Supplier:<br>
        <input type="text" name="nama"><br><br>

        Telp:<br>
        <input type="text" name="telp"><br><br>

        Alamat:<br>
        <textarea name="alamat"></textarea><br><br>

        <button type="submit" name="tambah">Simpan</button>

    </form>

<?php } ?>

<br><hr><br>


<!--  TABEL DATA  -->
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nama Supplier</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['telp'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td>
            <a href="data_supplier.php?edit=<?= $row['id'] ?>">Edit</a> |
            <a href="data_supplier.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus supplier ini?')">
                Hapus
            </a>
        </td>
    </tr>
    <?php } ?>

</table>
