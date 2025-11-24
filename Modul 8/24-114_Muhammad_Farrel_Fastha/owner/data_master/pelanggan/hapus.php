<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!isset($_GET['id'])) {
    header("location: pelanggan.php");
    exit;
}

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM pelanggan WHERE id = ?");
mysqli_stmt_bind_param($stmt, "s", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: pelanggan.php");
    exit;
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>
