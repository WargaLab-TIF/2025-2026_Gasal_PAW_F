<link rel="stylesheet" href="style.css">
<?php
include 'koneksi.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID Barang tidak ditemukan!'); window.location='barang.php';</script>";
    exit;
}

$id = $_GET['id'];

// Cek apakah barang digunakan di transaksi_detail
$cek = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = '$id'");
$data = mysqli_fetch_assoc($cek);

if ($data && $data['jumlah'] > 0) {
    // Barang digunakan
    echo "<script>
            alert('Barang ini sudah digunakan dalam transaksi! Tidak bisa dihapus.');
            window.location='barang.php';
          </script>";
} else {
    // Barang belum digunakan — konfirmasi sebelum hapus
    echo "<script>
            if (confirm('Yakin ingin menghapus barang ini?')) {
                window.location='barang_hapus_proses.php?id=$id';
            } else {
                window.location='barang.php';
            }
          </script>";
}
?>
