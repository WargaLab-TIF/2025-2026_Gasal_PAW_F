<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM supplier WHERE id = $id";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: data_supplier.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>
