<?php

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true ){
    echo "Anda tidak berhak mengakses halaman ini."; exit();
}
if ($_SESSION['level'] != '1') {
    echo "Akses ditolak! Hanya Owner/Admin."; exit();
}

require_once "conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$username = "";
$nama= "";
$alamat= "";
$hp= "";
$level= "";
$id_value = "";
$error= "";
$sukses= "";
$op= isset($_GET['op']) ? $_GET['op'] : "";


if($op == 'delete'){
    $id_del = $_GET['id'];
    try {
        if($_SESSION['username'] == $username) {
             throw new Exception("Tidak bisa menghapus akun yang sedang digunakan.");
        }
        $sql_del = "DELETE FROM user WHERE id_user = '$id_del'";
        if(mysqli_query($conn, $sql_del)){
            echo "<script>alert('User berhasil dihapus'); window.location='index.php?page=user';</script>";
        }
    } catch (Exception $e) {
        $error = "Gagal menghapus: User mungkin memiliki riwayat transaksi.";
    }
}

if($op == 'edit'){
    $id_edit = $_GET['id'];
    $sql1= "SELECT * FROM user WHERE id_user = '$id_edit'";
    $q1= mysqli_query($conn, $sql1);
    $r1= mysqli_fetch_array($q1);
    if($r1){
        $username = $r1['username'];
        $nama  = $r1['nama'];
        $alamat   = $r1['alamat'];
        $hp= $r1['hp'];
        $level= $r1['level'];
        $id_value = $r1['id_user'];
    } else { $error = "User tidak ditemukan"; }
}

if(isset($_POST['simpan'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama= $_POST['nama'];
    $alamat= $_POST['alamat'];
    $hp= $_POST['hp'];
    $level= $_POST['level'];
    $id_post = $_POST['id'];

    if($username && $nama && $alamat && $hp && $level){
        try {
            if($id_post){
                // Update
                if(!empty($password)){
                    $pass_hash = md5($password);
                    $sql1 = "UPDATE user SET username='$username', password='$pass_hash', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id_post'";
                } else {
                    $sql1 = "UPDATE user SET username='$username', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id_post'";
                }
                if(mysqli_query($conn, $sql1)) $sukses = "Data User berhasil diupdate";
                
            } else {
                if(!empty($password)){
                    $pass_hash = md5($password);
                    $sql1 = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES ('$username', '$pass_hash', '$nama', '$alamat', '$hp', '$level')";
                    if(mysqli_query($conn, $sql1)) $sukses = "User baru berhasil ditambahkan";
                } else {
                    $error = "Password wajib diisi untuk user baru.";
                }
            }
            if($sukses && empty($error)) echo "<script>window.location='index.php?page=user';</script>";

        } catch (mysqli_sql_exception $e) { $error = "Gagal menyimpan: " . $e->getMessage(); }
    } else { $error = "Silakan lengkapi semua data wajib."; }
}

$result = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC"), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar User</title>
    <link rel="stylesheet" href="./css/datamaster.css">
</head>
<body>
    <div class="container">
        <h2 class="judul">Daftar User</h2>
        <div class="btn-top">
            <a href="index.php?page=user#form-user">
                <button class="tambah" type="button"> + Tambah user</button>
            </a>
        </div>

        <?php if($error){ ?><div class="alert alert-error" style="background:#f8d7da;color:#721c24;padding:10px;margin-bottom:10px;"><?= $error ?></div><?php } ?>
        <?php if($sukses){ ?><div class="alert alert-success" style="background:#d4edda;color:#155724;padding:10px;margin-bottom:10px;"><?= $sukses ?></div><?php } ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>No</th><th>Username</th><th>Nama</th><th>Level</th><th>HP</th><th>Tindakan</th>
            </tr>
            <?php $no=1; foreach($result as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= ($row['level'] == 1) ? 'Owner' : 'Kasir'; ?></td>
                <td><?= $row['hp'] ?></td>
                <td>
                    <a href="index.php?page=user&op=edit&id=<?= $row['id_user'] ?>"><button class="edit" type="button">Edit</button></a>
                    <a href="index.php?page=user&op=delete&id=<?= $row['id_user'] ?>" onclick="return confirm('Hapus user ini?')"><button class="hapus" type="button">Hapus</button></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="form-container" id="form-user"style="margin-top:20px;">
            <h3><?= ($op == 'edit') ? "Edit User" : "Tambah User"; ?></h3>
            <form action="index.php?page=user" method="POST">
                <input type="hidden" name="id" value="<?= $id_value ?>">
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= $username ?>" required>
                </div>
                <div class="form-group">
                    <label>Password <?= ($op=='edit')?'(Kosongkan jika tidak diganti)':'' ?></label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= $nama ?>" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?= $alamat ?>" required>
                </div>
                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="hp" value="<?= $hp ?>" required>
                </div>
                <div class="form-group">
                    <label>Level Akses</label>
                    <select name="level" required>
                        <option value="">- Pilih Level -</option>
                        <option value="1" <?= ($level=='1')?'selected':'' ?>>Owner (Admin)</option>
                        <option value="2" <?= ($level=='2')?'selected':'' ?>>Kasir</option>
                    </select>
                </div>
                
                <button type="submit" name="simpan" class="btn-simpan">Simpan User</button>
                <a href="index.php?page=user" class="btn-batal"><button type="button" class="btn-batal">Reset</button></a>
            </form>
        </div>
    </div>
</body>
</html>