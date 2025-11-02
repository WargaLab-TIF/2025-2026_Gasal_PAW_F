<?php
    $conn =mysqli_connect("localhost", "root", "", "store");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $data = "DELETE FROM supplier WHERE id=$id";

        if (mysqli_query($conn, $data)){
            header("location: index.php");
            exit;
        }
    }
?>