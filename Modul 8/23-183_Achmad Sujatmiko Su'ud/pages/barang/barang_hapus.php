<?php
// pages/barang/barang_hapus.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

// PENCEGAHAN SQL INJECTION: Type Casting
$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM barang WHERE id_barang=$id");

header("Location: barang_list.php");
exit;