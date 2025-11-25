<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

$id = $_GET['id'];
$query_ambil = "SELECT * FROM user WHERE id_user = '$id'";
$result = mysqli_query($koneksi, $query_ambil);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];
    
    if ($_POST['password'] == "") {
        $query = "UPDATE user SET username='$username', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id'";
    } else {
        $password = md5($_POST['password']);
        $query = "UPDATE user SET username='$username', password='$password', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id'";
    }
    
    if (mysqli_query($koneksi, $query)) {
        header("location:data_user.php"); 
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit User</title><style>body{font-family:sans-serif; padding:20px;} input, textarea, select{width:100%; padding:8px;} .btn-simpan{background:#f0ad4e; color:white; border:none; padding:10px; cursor:pointer;}</style></head>
<body>
    <h3>Edit User</h3>
    <form method="POST">
        Username: <input type="text" name="username" value="<?php echo $data['username']; ?>" required>
        Password: <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
        Nama: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
        Alamat: <textarea name="alamat"><?php echo $data['alamat']; ?></textarea>
        HP: <input type="text" name="hp" value="<?php echo $data['hp']; ?>">
        Level: <select name="level" required>
            <option value="1" <?php if($data['level']==1) echo "selected";?>>Admin</option>
            <option value="2" <?php if($data['level']==2) echo "selected";?>>User Biasa</option>
        </select>
        <br><br>
        <input type="submit" name="update" value="Simpan Perubahan" class="btn-simpan">
        <a href="data_user.php">Batal</a>
    </form>
</body>
</html>