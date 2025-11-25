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
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id='$id'");
    header("Location: data_pelanggan.php");
    exit();
}


// TAMBAH DATA 
if (isset($_POST['tambah'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat)
                         VALUES ('$id', '$nama', '$jk', '$telp', '$alamat')");

    header("Location: data_pelanggan.php");
    exit();
}


// UPDATE DATA 
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "UPDATE pelanggan SET
        nama='$nama',
        jenis_kelamin='$jk',
        telp='$telp',
        alamat='$alamat'
        WHERE id='$id'
    ");

    header("Location: data_pelanggan.php");
    exit();
}


//  MENGAMBIL DATA EDIT 
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $q = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id'");
    $editData = mysqli_fetch_assoc($q);
}


//  TAMPIL DATA 
$data = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<h2>Data Pelanggan</h2>
<a href="home.php">Kembali</a>
<br><br>


<!--  FORM EDIT / TAMBAH  -->

<?php if ($editData) { ?>
    <h3>Edit Pelanggan</h3>
    <form method="POST">

        ID Pelanggan:<br>
        <input type="text" name="id" value="<?= $editData['id'] ?>" readonly><br><br>

        Nama:<br>
        <input type="text" name="nama" value="<?= $editData['nama'] ?>"><br><br>

        Jenis Kelamin:<br>
        <select name="jenis_kelamin">
            <option value="L" <?= ($editData['jenis_kelamin']=='L'?'selected':'') ?>>Laki-Laki</option>
            <option value="P" <?= ($editData['jenis_kelamin']=='P'?'selected':'') ?>>Perempuan</option>
        </select>
        <br><br>

        Telp:<br>
        <input type="text" name="telp" value="<?= $editData['telp'] ?>"><br><br>

        Alamat:<br>
        <textarea name="alamat"><?= $editData['alamat'] ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
        <a href="data_pelanggan.php">Batal</a>

    </form>

<?php } else { ?>

    <h3>Tambah Pelanggan Baru</h3>
    <form method="POST">

        ID Pelanggan:<br>
        <input type="text" name="id" placeholder="Contoh: PLG011"><br><br>

        Nama:<br>
        <input type="text" name="nama"><br><br>

        Jenis Kelamin:<br>
        <select name="jenis_kelamin">
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
        <br><br>

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
        <th>ID Pelanggan</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['jenis_kelamin'] ?></td>
        <td><?= $row['telp'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td>
            <a href="data_pelanggan.php?edit=<?= $row['id'] ?>">Edit</a> |
            <a href="data_pelanggan.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus pelanggan ini?')">
                Hapus
            </a>
        </td>
    </tr>
    <?php } ?>

</table>
