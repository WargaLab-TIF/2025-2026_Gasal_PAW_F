<?php
include "../cek_login.php";
include "../koneksi.php";

$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp  = $_POST['no_hp'];

$sql = "INSERT INTO supplier (nama, alamat, no_hp)
        VALUES ('$nama', '$alamat', '$no_hp')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: supplier.php");
} else {
    echo "Gagal menambah data!";
}
?>
