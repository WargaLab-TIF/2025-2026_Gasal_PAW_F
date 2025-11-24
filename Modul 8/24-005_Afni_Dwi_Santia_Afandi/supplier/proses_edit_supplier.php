<?php
include "../cek_login.php";
include "../koneksi.php";

$id     = $_POST['id'];
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp  = $_POST['telp'];

$sql = "UPDATE supplier SET 
        nama='$nama',
        alamat='$alamat',
        telp='$no_hp'
        WHERE id='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: supplier.php");
} else {
    echo "Gagal update data!";
}
?>
