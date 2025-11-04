<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// ambil semua barang yang pakai supplier 
$barang = mysqli_query($conn, "SELECT id FROM barang WHERE supplier_id=$id");
$barangIds = [];
while ($row = mysqli_fetch_assoc($barang)) {
    $barangIds[] = $row['id'];
}

// hapus transaksi_detail dan barang terkait
if (!empty($barangIds)) {
    $in = implode(",", $barangIds);
    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE barang_id IN ($in)");
    mysqli_query($conn, "DELETE FROM barang WHERE id IN ($in)");
}

// hapus supplier
$sql = "DELETE FROM supplier WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
