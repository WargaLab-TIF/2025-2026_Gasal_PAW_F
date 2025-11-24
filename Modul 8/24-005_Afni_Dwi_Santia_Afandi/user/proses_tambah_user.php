<?php
include "../cek_login.php";
include "../koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']); 
$nama     = $_POST['nama'];
$alamat   = $_POST['alamat'];
$hp       = $_POST['hp'];
$level    = $_POST['level'];

$sql = "INSERT INTO user (username,password,nama,alamat,hp,level)
        VALUES ('$username','$password','$nama','$alamat','$hp','$level')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: user.php");
} else {
    echo "Gagal tambah user!";
}
?>
