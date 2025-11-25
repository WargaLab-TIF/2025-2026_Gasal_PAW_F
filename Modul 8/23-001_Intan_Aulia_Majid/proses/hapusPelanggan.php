<?php
include "../koneksi.php";

$idPelanggan = $_GET['id'];

$stmt = $koneksi->prepare("DELETE FROM pelanggan WHERE id = ?");
$stmt->bind_param("i", $idPelanggan);
$stmt->execute();
$stmt->close();

header("location: ../pelanggan.php");
exit;