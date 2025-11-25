<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:authentikasi/login.php?pesan=belum_login");
    exit(); 
}
?>