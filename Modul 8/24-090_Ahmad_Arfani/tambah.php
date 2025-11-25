<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];
    
    $query = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')";
    
    if (mysqli_query($koneksi, $query)) {
        header("location:data_user.php");
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <style>body{font-family:sans-serif; padding:20px;} input, textarea, select{width:100%; padding:8px; margin:5px 0;} .btn-simpan{background:blue; color:white; border:none; padding:10px; cursor:pointer;}</style>
</head>
<body>
    <h3>Tambah User Baru</h3>
    <form method="POST">
        Username: <input type="text" name="username" required>
        Password: <input type="password" name="password" required>
        Nama: <input type="text" name="nama" required>
        Alamat: <textarea name="alamat"></textarea>
        HP: <input type="text" name="hp">
        Level: <select name="level" required>
            <option value="1">Admin</option>
            <option value="2">User Biasa</option>
        </select>
        <br><br>
        <input type="submit" name="simpan" value="Simpan" class="btn-simpan">
        <a href="data_user.php">Batal</a>
    </form>
</body>
</html>