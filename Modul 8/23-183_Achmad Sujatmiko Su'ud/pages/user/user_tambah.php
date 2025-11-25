<?php
// pages/user/user_tambah.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];

    // PENCEGAHAN SQL INJECTION
    $username = mysqli_real_escape_string($conn, $username);
    $nama     = mysqli_real_escape_string($conn, $nama);
    $alamat   = mysqli_real_escape_string($conn, $alamat);
    $hp       = mysqli_real_escape_string($conn, $hp);
    
    mysqli_query($conn, "INSERT INTO user (username, password, nama, level, alamat, hp) 
                         VALUES ('$username', '$password', '$nama', '$level', '$alamat', '$hp')");
    header("Location: user_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include "../../includes/navigasi.php"; ?>
    <div class="container" style="width: 450px;">
        <h2 style="text-align:left; color: #007bff; margin-bottom: 25px;">Tambah User Baru</h2>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Nama User</label>
            <input type="text" name="nama" required>
            <label>Alamat</label>
            <textarea name="alamat" rows="4"></textarea>
            <label>Nomor HP</label>
            <input type="text" name="hp">
            <label>Jenis User</label>
            <select name="level" required>
                <option value="2">User Biasa</option>
                <option value="1">Admin</option>
            </select>
            <div style="margin-top: 20px;">
                <button class="btn btn-blue" type="submit">Simpan</button>
                <a class="btn btn-red" href="user_list.php">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>