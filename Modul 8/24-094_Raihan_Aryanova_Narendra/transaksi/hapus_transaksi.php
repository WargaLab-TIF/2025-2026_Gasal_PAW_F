<?php
include 'koneksi.php';
$id = $_GET['id'];
if(isset($id)) {
    $query = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id'");

    if($query) {
        echo "<script>
                alert('Data transaksi berhasil dihapus!');
                window.location = 'transaksi.php';
              </script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../home.php?page=transaksi");
}
?>