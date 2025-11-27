<?php
$conn = mysqli_connect("localhost", "root", "", "master-detail");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$id   = intval($_GET['id'] ?? 0);
$back = "barang_list.php";

if ($id <= 0) {
    echo "<script>
            alert('ID tidak valid');
            location.href = '$back';
          </script>";
    exit;
}

$q   = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM transaksi_detail WHERE barang_id = $id");
$cek = mysqli_fetch_assoc($q);

if (intval($cek['jml']) > 0) {
    echo "<script>
            alert('Barang tidak dapat dihapus karena sudah digunakan pada transaksi.');
            location.href = '$back';
          </script>";
    exit;
}

mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

echo "<script>
        alert('Barang berhasil dihapus.');
        location.href = '$back';
      </script>";
exit;
