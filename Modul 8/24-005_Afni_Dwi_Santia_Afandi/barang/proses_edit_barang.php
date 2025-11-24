<?php
include "../cek_login.php";
include "../koneksi.php";

$id     = $_POST['id'];
$kode   = $_POST['kode_barang'];
$nama   = $_POST['nama_barang'];
$harga  = $_POST['harga'];
$stok   = $_POST['stok'];
$supp   = $_POST['supplier_id'];

$sql = "UPDATE barang SET
        kode_barang='$kode',
        nama_barang='$nama',
        harga='$harga',
        stok='$stok',
        supplier_id='$supp'
        WHERE id='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: barang.php");
} else {
    echo "Gagal update data!";
}
?>
