<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!isset($_GET['id'])) {
    header("location: supplier.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($conn, "DELETE FROM supplier WHERE id = ?");

mysqli_stmt_bind_param($stmt, "i", $id);
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("location: supplier.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
mysqli_stmt_close($stmt);

?>
