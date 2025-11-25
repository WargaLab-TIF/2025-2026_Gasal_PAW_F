<?php
// pages/supplier/supplier_tambah.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_supplier']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);

    mysqli_query($conn, "INSERT INTO supplier (nama_supplier, alamat, hp) 
                         VALUES ('$nama', '$alamat', '$hp')");
    
    header("Location: supplier_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <div class="container" style="width: 450px;">
        <h2 style="text-align:left; color: #007bff; margin-bottom: 25px;">Tambah Supplier Baru</h2>

        <form method="POST">

            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" required>

            <label>Alamat</label>
            <textarea name="alamat" rows="4"></textarea>
            
            <label>Nomor HP</label>
            <input type="text" name="hp">

            <div style="margin-top: 20px;">
                <button class="btn btn-blue" type="submit">Simpan</button>
                <a class="btn btn-red" href="supplier_list.php">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>