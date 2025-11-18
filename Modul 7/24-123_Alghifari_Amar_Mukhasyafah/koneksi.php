<?php
$conn = mysqli_connect("localhost", "root", "", "suplier");

if(!$conn){
    die("Database gagal konek: " . mysqli_connect_error());
}
?>
