<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM pelanggan WHERE id = $id");
}

header("Location: ../../data-master/data_pelanggan.php");
exit;