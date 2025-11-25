<?php

    include "../../koneksi.php";


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM supplier WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nama = $_POST["nama"];
        $telp = $_POST["telp"];
        $alamat = $_POST["alamat"];

        $sql = "UPDATE supplier SET nama = '$nama', alamat = '$alamat', telp = '$telp' WHERE id = $id";

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
            <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?>"><br><br>
            
            <label for="alamat">Alamat: </label><br>
            <textarea name="alamat" id="alamat"><?= $result['alamat'] ?></textarea><br><br>
                        
            <label for="telp">No Telepon: </label><br>
            <input type="number" name="telp" id="telp" value="<?= $result['telp'] ?>"><br><br>
            
            <input type="hidden" name="id_user" value="<?= $result['id'] ?>">

            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='suplier.php'">Batal</button>
        </form>
    </div>
</body>
</html>