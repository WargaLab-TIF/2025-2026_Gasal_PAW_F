<?php
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

if($_SESSION['level']!=1){
    echo "<script>alert('Anda tidak memiliki akses ke halaman ini!'); 
    window.location='index.php';</script>";
    exit();
}
?>