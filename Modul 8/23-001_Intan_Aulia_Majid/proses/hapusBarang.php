<?php
include "../koneksi.php";

$idBarang = $_GET['id'];

$stmt = $koneksi->prepare("DELETE FROM barang WHERE id = ?");
$stmt->bind_param("i", $idBarang);
$stmt->execute();
$stmt->close();

header("location: ../barang.php");
exit;