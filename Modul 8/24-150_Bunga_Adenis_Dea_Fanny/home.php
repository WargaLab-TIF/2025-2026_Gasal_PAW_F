<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
<h2 style="margin:20px;">Selamat datang, <?= $_SESSION['nama']; ?>!</h2>
</body>
</html>
