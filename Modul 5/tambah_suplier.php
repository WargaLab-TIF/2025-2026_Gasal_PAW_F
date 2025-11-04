<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST["nama"];
    $telp   = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: data_supplier.php");
        exit;
    } else {
        echo "Gagal menambah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>
</head>
<body>
    <h2>Tambah Data Supplier</h2>
    <form action="" method="POST">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br>
        <label>Telepon:</label><br>
        <input type="text" name="telp" required><br>
        <label>Alamat:</label><br>
        <textarea name="alamat" rows="3" cols="30" required></textarea><br><br>

        <input type="submit" value="Simpan">
        <input type="button" value="Batal" onclick="window.location.href='data_supplier.php'">
    </form>
</body>
</html>
