<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'store';
$username = 'root';
$password = '';

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $dbname);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Proses menghapus data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM supplier WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Redirect kembali ke halaman utama setelah hapus data
header("Location: index.php");
exit;
?>
