<?php
    session_start();
    if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
    require "../conn.php";
    $id = $_GET['id'];
    $hapus_detail = mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id = '$id'");
    $hapus_header = mysqli_query($conn, "DELETE FROM transaksi WHERE id = '$id'");
    if ($hapus_detail && $hapus_header) {
        echo "<script>alert('Transaksi berhasil dihapus!');window.location='transaksi.php';</script>";
    } else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>