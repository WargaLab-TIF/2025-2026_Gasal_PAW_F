<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $cek = mysqli_query($conn, "
        SELECT * FROM transaksi_detail WHERE barang_id = '$id'
    ");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail!');
                window.location='../../data-master/data_barang.php';
              </script>";
        exit;
    }

    mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");

    echo "<script>
            alert('Barang berhasil dihapus!');
            window.location='../../data-master/data_barang.php';
          </script>";
    exit;
}