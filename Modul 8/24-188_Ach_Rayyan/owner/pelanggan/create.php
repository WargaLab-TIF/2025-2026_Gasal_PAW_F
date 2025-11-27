<?php

    include "../../koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["nama"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];
        $jenis_kelamin = $_POST["jenis_kelamin"];

        $sql = "INSERT INTO pelanggan (nama, alamat, telp, jenis-kelamin) VALUES ('$nama', '$alamat', '$telp', '$jenis_kelamin')";
        if (mysqli_query($conn, $sql)) {
            header("location: pelanggan.php");
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
            <label for="nama">Nama Pelanggan: </label><br>
            <input type="text" name="nama" id="nama"><br><br>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="" id="">
                <option value="">--- Jenis Kelamin ---</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
            
            <label for="telp">No Telepon: </label><br>
            <input type="number" name="telp" id="telp"><br><br>
            
            <label for="alamat">Alamat: </label><br>
            <textarea name="alamat" id="alamat"></textarea><br><br>
            
            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='pelanggan.php'">Batal</button>
        </form>
    </div>
</body>
</html>