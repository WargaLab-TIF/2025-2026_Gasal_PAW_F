<?php
include "../koneksi.php";

$id = $_GET['id'];

$stmt = $koneksi->prepare("DELETE FROM supplier WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: ../supplier.php");
exit;

