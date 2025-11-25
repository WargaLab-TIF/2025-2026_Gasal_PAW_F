<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";


//  HAPUS DATA USER 
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM user WHERE id_user='$id'");
    header("Location: data_user.php");
    exit();
}


//  TAMBAH USER 
if (isset($_POST['tambah'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);  
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];

    mysqli_query($conn, "INSERT INTO user (username, password, nama, alamat, hp, level)
                         VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')");

    header("Location: data_user.php");
    exit();
}


//  UPDATE USER 
if (isset($_POST['update'])) {

    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];


    if ($_POST['password'] != "") {
        $password = md5($_POST['password']);
        $query = "UPDATE user SET 
                    username='$username',
                    password='$password',
                    nama='$nama',
                    alamat='$alamat',
                    hp='$hp',
                    level='$level'
                  WHERE id_user='$id_user'";
    } 
    
    else {
        $query = "UPDATE user SET 
                    username='$username',
                    nama='$nama',
                    alamat='$alamat',
                    hp='$hp',
                    level='$level'
                  WHERE id_user='$id_user'";
    }

    mysqli_query($conn, $query);
    header("Location: data_user.php");
    exit();
}


//  DATA EDIT 
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $q = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
    $editData = mysqli_fetch_assoc($q);
}


//  TAMPILKAN DATA 
$data = mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC");
?>

<h2>Data User</h2>
<a href="home.php">Kembali</a>
<br><br>

<!--  FORM EDIT / TAMBAH  -->

<?php if ($editData) { ?>
    <h3>Edit User</h3>

    <form method="POST">
        <input type="hidden" name="id_user" value="<?= $editData['id_user'] ?>">

        Username:<br>
        <input type="text" name="username" value="<?= $editData['username'] ?>"><br><br>

        Password (isi jika ingin ubah):<br>
        <input type="password" name="password"><br><br>

        Nama:<br>
        <input type="text" name="nama" value="<?= $editData['nama'] ?>"><br><br>

        Alamat:<br>
        <textarea name="alamat"><?= $editData['alamat'] ?></textarea><br><br>

        HP:<br>
        <input type="text" name="hp" value="<?= $editData['hp'] ?>"><br><br>

        Level:<br>
        <select name="level">
            <option value="1" <?= ($editData['level']==1?'selected':'') ?>>Owner</option>
            <option value="2" <?= ($editData['level']==2?'selected':'') ?>>Kasir</option>
            <option value="3" <?= ($editData['level']==3?'selected':'') ?>>Staff</option>
        </select>
        <br><br>

        <button type="submit" name="update">Update</button>
        <a href="data_user.php">Batal</a>
    </form>

<?php } else { ?>

    <h3>Tambah User Baru</h3>

    <form method="POST">

        Username:<br>
        <input type="text" name="username"><br><br>

        Password:<br>
        <input type="password" name="password"><br><br>

        Nama:<br>
        <input type="text" name="nama"><br><br>

        Alamat:<br>
        <textarea name="alamat"></textarea><br><br>

        HP:<br>
        <input type="text" name="hp"><br><br>

        Level:<br>
        <select name="level">
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
            <option value="3">Staff</option>
        </select>
        <br><br>

        <button type="submit" name="tambah">Simpan</button>
    </form>

<?php } ?>

<br><hr><br>

<!--  TABEL TAMPIL  -->

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>HP</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= $row['id_user'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['hp'] ?></td>
        <td>
            <?php
                if ($row['level'] == 1) echo "Owner";
                elseif ($row['level'] == 2) echo "Kasir";
                else echo "Staff";
            ?>
        </td>
        <td>
            <a href="data_user.php?edit=<?= $row['id_user'] ?>">Edit</a> |
            <a href="data_user.php?hapus=<?= $row['id_user'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>
