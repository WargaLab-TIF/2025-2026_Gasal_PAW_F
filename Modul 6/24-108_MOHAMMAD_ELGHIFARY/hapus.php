<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "penjualan_tp6";
$koneksi = mysqli_connect($servername, $username, $password, $db);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $barang_id = (int)$_GET['id'];
    $hapus_barang = mysqli_query($koneksi, "DELETE FROM barang WHERE id = $barang_id");
    if ($hapus_barang) {
        header("location: index.php");
    } else {
        echo "Gagal menghapus barang: " . mysqli_error($koneksi);
    }
}
?>