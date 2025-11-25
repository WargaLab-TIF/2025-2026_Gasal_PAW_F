<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) { header("location:index.php"); exit; }

$id = $_GET['id'];
$query = "DELETE FROM user WHERE id_user = '$id'";
if (mysqli_query($koneksi, $query)) {
    header("location:data_user.php");
} else {
    echo "Gagal menghapus data.";
}
?>