<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!isset($_GET['id_user'])) {
    header("location: data_user.php");
    exit;
}

$id_user = intval($_GET['id_user']);

$stmt = mysqli_prepare($conn, "DELETE FROM user WHERE id_user = ?");

mysqli_stmt_bind_param($stmt, "i", $id_user);
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("location: data_user.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
mysqli_stmt_close($stmt);

?>
