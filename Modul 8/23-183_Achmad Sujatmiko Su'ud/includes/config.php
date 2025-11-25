<?php
// includes/config.php
session_start();

$host = "localhost";
$user = "root";
$pass = "admin";
$db   = "admin";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}