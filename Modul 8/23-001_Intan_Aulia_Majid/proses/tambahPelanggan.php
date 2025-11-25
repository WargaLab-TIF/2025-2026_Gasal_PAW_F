<?php

include "../koneksi.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){ 
    $id       = $_POST['id'];
    $nama     = $_POST['nama'];
    $telepon  = $_POST['telepon'];
    $alamat   = $_POST['alamat'];

    $stmt = $koneksi->prepare("
        INSERT INTO pelanggan (id, nama, telp, alamat) 
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("isss", $id, $nama, $telepon, $alamat);
    $stmt->execute();
    $stmt->close();

    header("location: ../pelanggan.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
</head>
<body>
    <h3>Tambah Pelanggan</h3>

    <form action="" method="POST">

        <label>ID Pelanggan</label><br>
        <input type="text" name="id"><br><br>

        <label>Nama Pelanggan</label><br>
        <input type="text" name="nama"><br><br>

        <label>No. Telepon</label><br>
        <input type="text" name="telepon"><br><br>

        <label>Alamat</label><br>
        <textarea name="alamat"></textarea><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
