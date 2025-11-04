<?php
$koneksi = mysqli_connect("localhost", "root", "", "storee");

if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Proses menghapus data jika ID tersedia
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = "DELETE FROM supplier WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        $message = "Data berhasil dihapus!";
    } else {
        $message = "Error: " . mysqli_error($koneksi);
    }

    // Redirect kembali ke halaman utama dengan pesan sukses atau error
    header("Location: index.php?message=" . urlencode($message));
    exit;
}
?>
