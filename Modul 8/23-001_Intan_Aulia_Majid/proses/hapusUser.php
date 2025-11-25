<?php

include "../koneksi.php";

$id = $_GET['id'];

$stmt = $koneksi->prepare("DELETE FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: ../user.php");
exit;

