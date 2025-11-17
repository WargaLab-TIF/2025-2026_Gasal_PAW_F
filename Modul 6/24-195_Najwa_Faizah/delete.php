<?php
include 'koneksi.php';

if (isset($_GET['id']) && !isset($_GET['confirm'])) {
    $id = $_GET['id'];

    $checkQuery = "SELECT COUNT(*) AS count FROM transaksi_detail WHERE barang_id = '$id'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['count'] > 0) {
        echo "<script>
                alert('Barang tidak dapat dihapus karena sudah digunakan dalam transaksi detail');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "<script>
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'delete.php?id=$id&confirm=true';
        } else {
            window.location.href = 'index.php';
        }
      </script>";
      exit;
    }

} elseif (isset($_GET['confirm']) && $_GET['confirm'] == 'true' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM barang WHERE id = '$id'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>
                alert('Barang berhasil dihapus.');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menghapus barang.');
                window.location.href = 'index.php';
              </script>";
        exit;
    }

} else {
    header('Location: index.php');
    exit;
}
?>
