<?php
include "../cek_login.php";
include "../koneksi.php";

$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp  = $_POST['telp'];

$sql = "INSERT INTO pelanggan (nama, alamat, telp)
        VALUES ('$nama', '$alamat', '$telp')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: pelanggan.php");
} else {
    echo "Gagal menambah data!";
}
?>
