<?php
include 'core/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah barang sudah digunakan di transaksi_detail
    $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id = '$id'");

    if (mysqli_num_rows($cek) > 0) {
        // Barang sudah digunakan → tampilkan alert dan batalkan penghapusan
        echo "<script>
                alert('Barang ini sudah digunakan dalam transaksi! Tidak dapat dihapus.');
                window.location='tampil_barang.php';
              </script>";
    } else {
        // Barang belum digunakan → aman untuk dihapus
        $hapus = mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");
        if ($hapus) {
            echo "<script>
                    alert('Barang berhasil dihapus!');
                    window.location='tampil_barang.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus barang: " . mysqli_error($conn) . "');
                    window.location='tampil_barang.php';
                  </script>";
        }
    }
}
?>
