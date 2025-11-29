<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$level_display = isset($_SESSION['level']) ? $_SESSION['level'] : 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <style>
            body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        </style>
    </head>
    <body>
    <?php include 'menu.php'; ?>
    <div style="padding: 40px; text-align: center;">
        <h2>Selamat Datang</h2>
        <p>Anda login sebagai **
            <?php
            echo ($level_display == 1 ? "Owner" : "Kasir");
            ?>
        **.</p>
    </div>
</body>
</html>