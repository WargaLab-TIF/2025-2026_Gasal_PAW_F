<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 1) {
    echo "<script>alert('Akses Ditolak! Hanya Owner yang berhak menghapus User.'); window.location='index.php';</script>";
    exit;
}

$id_user = mysqli_real_escape_string($koneksi, $_POST['id'] ?? 0);

$hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

if ($hapus) {
    header("Location: master.php");
} else {
    echo "<script>alert('Gagal menghapus data user! Kesalahan database.'); window.location='master.php';</script>";
}
exit;
?>