<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID User tidak ditemukan.");
}
$id_user = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql_delete = "DELETE FROM user WHERE id = '$id_user'";
if (mysqli_query($koneksi, $sql_delete)) {
    header("Location: data_user.php?status=sukses_hapus");
    exit();
} else {
    echo "Gagal menghapus data user: " . mysqli_error($koneksi);
}
mysqli_close($koneksi);
?>