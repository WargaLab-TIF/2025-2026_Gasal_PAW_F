<?php
include 'koneksi.php';

if (isset($_GET['ID'])) {
    $id_barang = $_GET['ID'];
    $sql_cek = "SELECT * FROM transaksi_detail WHERE ID_barang = '$id_barang'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    if (!$query_cek) {
        die("Error cek hapus: " . mysqli_error($koneksi));
    }
    $jumlahh = mysqli_num_rows($query_cek);
    if ($jumlahh > 0) {
        echo "<script>
                alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        $hapus_sql = "DELETE FROM barang WHERE id = '$id_barang'";
        $hasil = mysqli_query($koneksi, $hapus_sql);
        if ($hasil) {
            echo "<script>
                    alert('Barang berhasil dihapus.');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        } else {
            echo "<script>
                    alert('Gagal menghapus barang: " . mysqli_error($koneksi) . "');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>