<?php
include '../session/cek_session.php';
include '../koneksi.php';

$pelanggan_id = $_POST['pelanggan_id'];
$total = $_POST['total'];

mysqli_query($koneksi, "INSERT INTO transaksi (pelanggan_id, tanggal, total) VALUES ('$pelanggan_id', NOW(), '$total')");

$id_transaksi = mysqli_insert_id($koneksi);

$barang_id = $_POST['barang_id'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];

for ($i=0; $i < count($barang_id); $i++) {

    if($barang_id[$i] == "") continue;
    mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga, subtotal) VALUES ('$id_transaksi', '$barang_id[$i]', '$qty[$i]', '$harga[$i]', '$subtotal[$i]')");
}

header("Location: transaksi_index.php");
exit;
?>