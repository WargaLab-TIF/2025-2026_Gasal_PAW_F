<?php
// transaksi.php
include "includes/config.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Penjualan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include "includes/navigasi.php"; ?> 

    <div class="container" style="width: 80%; max-width: 900px; margin-top: 25px;">
        <h2>Halaman Transaksi</h2>
        <p style="text-align: center;">Ini adalah tempat untuk logika penjualan, kasir, dan pencatatan transaksi.</p>
        
        <div style="border: 1px dashed #444; padding: 20px; margin-top: 20px;">
            <p style="text-align: center; color: #aaa;">*(Logika input dan database transaksi perlu diimplementasikan sesuai modul sebelumnya.)*</p>
        </div>
    </div>

</body>
</html>