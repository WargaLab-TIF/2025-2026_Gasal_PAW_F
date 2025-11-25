<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM supplier WHERE id_supplier = $id"; 
    if ($conn->query($query) === TRUE) {
        header("Location: index.php?pesan=sukses_hapus");
    } else {
        header("Location: index.php?pesan=gagal_hapus");
    }
} else {
    header("Location: index.php?pesan=gagal_hapus");
}

$conn->close();
?>
