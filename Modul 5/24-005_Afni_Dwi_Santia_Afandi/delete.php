<?php
include "koneksi.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // query hapus data supplier berdasarkan id
    $sql = "DELETE FROM supplier WHERE id = $id";

    if(mysqli_query($koneksi, $sql)){
        header("location: index.php");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>
