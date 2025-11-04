<?php

$conn = mysqli_connect("localhost", "root", "", "store");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM supplier WHERE id = $id";

    if(mysqli_query($conn, $query)){
        header("location: index.php");
    }

}