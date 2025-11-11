<?php
include "koneksi.php";

$id = $_GET['id'];

$cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id = '$id'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Barang sudah digunakan dalam transaksi dan tidak bisa dihapus!');
        window.location.href = 'index.php';
    </script>";
} else {
    $hapus = mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");
    if ($hapus) {
        echo "<script>
            alert('Barang berhasil dihapus!');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data!');
            window.location.href = 'index.php';
        </script>";
    }
}
?>
