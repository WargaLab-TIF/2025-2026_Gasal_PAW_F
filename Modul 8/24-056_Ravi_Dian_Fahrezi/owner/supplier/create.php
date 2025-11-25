<?php

    include "../../koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["nama"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];

        $sql = "INSERT INTO supplier (nama, alamat, telp) VALUES ('$nama', '$alamat', '$telp')";
        if (mysqli_query($conn, $sql)) {
            header("location: supplier.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inputStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <label for="nama">Nama Supplier: </label><br>
            <input type="text" name="nama" id="nama"><br><br>
            
            <label for="alamat">Alamat: </label><br>
            <textarea name="alamat" id="alamat"></textarea><br><br>
                        
            <label for="telp">No Telepon: </label><br>
            <input type="number" name="telp" id="telp"><br><br>
            
            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='supplier.php'">Batal</button>
        </form>
    </div>
</body>
</html>