<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail!');
            window.location='barang.php';
        </script>";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
        if ($hapus) {
            echo "<script>
                alert('Data barang berhasil dihapus!');
                window.location='barang.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus data barang: " . mysqli_error($koneksi) . "');
                window.location='barang.php';
            </script>";
        }
    }
} else {
    echo "<script>window.location='barang.php';</script>";
}
?>
