<?php

    include "koneksi.php";
    require 'validate.php';

    $errors = [];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM supplier WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Jalankan semua validasi (tidak berhenti di satu field)
        validateName($_POST, 'nama', $errors);
        validateTelepon($_POST, 'telp', $errors);
        validateAlamat($_POST, 'alamat', $errors);

        // Kalau tidak ada error sama sekali
        if (empty($errors)) {
            $id = $_POST['id'];
            $nama = $_POST["nama"];
            $telp = $_POST["telp"];
            $alamat = $_POST["alamat"];

            $sql = "UPDATE supplier SET nama = '$nama' , telp = '$telp' , alamat = '$alamat' WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                header("location: index.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/inputStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="error-container">
                <h4>Terjadi kesalahan</h4>
                <?php foreach ($errors as $errorMsg): ?>
                    <p><?= $errorMsg ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
        <label for="nama">Nama</label><br>
        <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?>"><br><br>

        <label for="telp">Telepon</label><br>
        <input type="text" name="telp" id="telp" value="<?= $result['telp'] ?>"><br><br>

        <label for="alamat">Alamat</label><br>
        <input type="text" name="alamat" id="alamat" value="<?= $result['alamat'] ?>"><br><br>

        <input type="hidden" name="id" value="<?= $result['id'] ?>">
 
        <button type="submit" name="submit" id="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php'">Batal</button>
    </form>
    </div>
</body>
</html>