<?php

    include "../../koneksi.php";


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pelanggan WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nama = $_POST["nama"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];
        $jenis_kelamin = $_POST["jenis_kelamin"];

        $sql = "UPDATE pelanggan SET nama = '$nama', alamat = '$alamat', telp = '$telp', jenis_kelamin = '$jenis_kelamin' WHERE id = $id";

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
            <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?>"><br><br>

            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="" id="">
                <option value="">--- Jenis Kelamin ---</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
            
            <label for="telp">No Telepon: </label><br>
            <input type="number" name="telp" id="telp" value="<?= $result['telp'] ?>"><br><br>
            
            <label for="alamat">Alamat: </label><br>
            <textarea name="alamat" id="alamat"><?= $result['alamat'] ?></textarea><br><br>
            
            <input type="hidden" name="id" value="<?= $result['id'] ?>">

            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='pelanggan.php'">Batal</button>
        </form>
    </div>
</body>
</html>