<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id = $id");
mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");

header("Location: transaksi.php");
exit;