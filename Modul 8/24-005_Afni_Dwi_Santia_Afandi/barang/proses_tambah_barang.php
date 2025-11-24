<?php
include "../cek_login.php";
include "../koneksi.php";

$kode   = $_POST['kode_barang'];
$nama   = $_POST['nama_barang'];
$harga  = $_POST['harga'];
$stok   = $_POST['stok'];
$supp   = $_POST['supplier_id'];

$sql = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
        VALUES ('$kode', '$nama', '$harga', '$stok', '$supp')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: barang.php");
} else {
    echo "Gagal menambah data!";
}
?>
