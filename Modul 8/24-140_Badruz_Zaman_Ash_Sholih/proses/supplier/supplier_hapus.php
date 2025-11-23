<?php 
    $conn = mysqli_connect("Localhost", "root", "", "penjualan");

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM supplier WHERE id = $id";
        if(mysqli_query($conn, $sql)) {
            header("Location: ../../data-master/data_supplier.php");
        }
    }
?>