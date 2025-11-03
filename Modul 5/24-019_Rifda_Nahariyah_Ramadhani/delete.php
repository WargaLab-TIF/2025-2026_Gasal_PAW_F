<?php
include "koneksi.php";

if(isset($_GET['no'])){
    $nomor = $_GET['no'];

    $sql = "DELETE FROM supplier WHERE id='$nomor'";
    if(mysqli_query($conn, $sql)){
        header("Location: index.php");
    }
}
?>
