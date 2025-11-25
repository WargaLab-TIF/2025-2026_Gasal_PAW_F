<?php
// laporan.php
include "includes/config.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include "includes/navigasi.php"; ?> 

    <div class="container" style="width: 80%; max-width: 900px; margin-top: 25px;">
        <h2>Halaman Laporan</h2>
        <p style="text-align: center;">Di sini akan ditampilkan ringkasan penjualan, stok, dan keuntungan.</p>
        
        <div style="border: 1px dashed #444; padding: 20px; margin-top: 20px;">
            <p style="text-align: center; color: #aaa;">*(Logika query database untuk membuat laporan perlu diimplementasikan.)*</p>
        </div>
    </div>

</body>
</html>