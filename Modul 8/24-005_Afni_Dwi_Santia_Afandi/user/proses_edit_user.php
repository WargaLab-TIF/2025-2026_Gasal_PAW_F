<?php
include "../cek_login.php";
include "../koneksi.php";

$id       = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama     = $_POST['nama'];
$alamat   = $_POST['alamat'];
$hp       = $_POST['hp'];
$level    = $_POST['level'];

$sql = "UPDATE user SET 
        username='$username',
        password='$password',
        nama='$nama',
        alamat='$alamat',
        hp='$hp',
        level='$level'
        WHERE id_user='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: user.php");
} else {
    echo "Gagal update user!";
}
?>
