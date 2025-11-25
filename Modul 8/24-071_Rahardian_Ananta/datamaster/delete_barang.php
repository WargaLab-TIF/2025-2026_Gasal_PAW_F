<?php
    session_start();
    if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
    require "../conn.php";
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");
    header("Location: datamaster.php");
?>