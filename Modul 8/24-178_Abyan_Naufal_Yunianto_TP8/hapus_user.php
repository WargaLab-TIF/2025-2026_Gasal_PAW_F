<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 1) {
    header("location: index.php");
    exit;
}

$id = $_GET['id'];
$conn->query("DELETE FROM user WHERE id_user='$id'");
header("Location: data_user.php");
?>