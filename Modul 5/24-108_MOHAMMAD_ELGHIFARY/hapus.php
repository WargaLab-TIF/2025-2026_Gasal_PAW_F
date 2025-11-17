<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="store";
$koneksi = mysqli_connect($servername, $username, $password, $db);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];
    $barang_query = mysqli_query($koneksi, "SELECT id FROM barang WHERE supplier_id = '$supplier_id'");
    while ($barang = mysqli_fetch_assoc($barang_query)) {
        $barang_id = $barang['id'];
        mysqli_query($koneksi, "DELETE FROM transaksi_detail WHERE barang_id = '$barang_id'");
    }
    mysqli_query($koneksi, "DELETE FROM barang WHERE supplier_id = '$supplier_id'");
    $hapus_supplier = mysqli_query($koneksi, "DELETE FROM supplier WHERE id = '$supplier_id'");

    if ($hapus_supplier) {
        header("location: index.php");
    } else {
        echo "Gagal menghapus supplier: " . mysqli_error($koneksi);
    }
}
?>