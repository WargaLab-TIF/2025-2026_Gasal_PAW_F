<?php include "cek_login.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
<h2>Selamat datang, <?= $_SESSION["nama"]; ?></h2>

    <?php if($_SESSION["level"] == 1){ ?>
        <a href="?p=barang">Data Barang</a> |
        <a href="?p=user">Data User</a> |
    <?php } ?>

    <a href="?p=transaksi">Transaksi</a> |
    <a href="?p=laporan">Laporan</a> |
    <a href="aksi.php?aksi=logout">Logout</a>
<hr>

</body>
</html>

<?php include "page.php"; ?>
