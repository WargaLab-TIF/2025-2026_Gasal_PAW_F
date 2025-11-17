<?php
require_once "conn.php";

if (isset($_GET['id'])) {
    $transaksi_id = (int)$_GET['id'];
    $hapus_transaksi = mysqli_query($conn, "DELETE FROM transaksi WHERE id = $transaksi_id");
    if ($hapus_transaksi) {
        header("location: index.php");
    } else {
        echo "Gagal menghapus transaksi: " . mysqli_error($koneksi);
    }
}
?>