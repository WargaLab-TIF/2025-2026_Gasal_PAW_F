<?php
// index.php
include "includes/config.php"; 

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>

    <?php include "includes/navigasi.php"; ?> 

    <div class="container" style="width: 450px;">
        <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['nama']) ?></h2>
        <p style="text-align: center;">Anda login sebagai **<?= ((int)$_SESSION['level'] === 1) ? 'Administrator' : 'User Biasa' ?>** (Level: <?= htmlspecialchars($_SESSION['level']) ?>).</p>
        <p style="text-align: center; margin-top: 30px;">Silakan pilih menu di atas.</p>
    </div>

</body>
</html>