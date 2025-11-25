<?php
// pages/supplier/supplier_hapus.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

// PENCEGAHAN SQL INJECTION: Type Casting
$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM supplier WHERE id_supplier=$id");

header("Location: supplier_list.php");
exit;