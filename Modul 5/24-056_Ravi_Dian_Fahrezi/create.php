<?php

    include "koneksi.php";
    require 'validate.php';

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Jalankan semua validasi (tidak berhenti di satu field)
        validateName($_POST, 'nama', $errors);
        validateTelepon($_POST, 'telp', $errors);
        validateAlamat($_POST, 'alamat', $errors);

        // Kalau tidak ada error sama sekali
        if (empty($errors)) {
            $nama = $_POST["nama"];
            $telp = $_POST["telp"];
            $alamat = $_POST["alamat"];

            $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
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
        <form action="" method="POST">
        <label for="nama">Nama: </label><br>
        <input type="text" name="nama" id="nama" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>"><br><br>

        <label for="telp">Telepon: </label><br>
        <input type="text" name="telp" id="telp" value="<?php echo isset($_POST['telp']) ? htmlspecialchars($_POST['telp']) : ''; ?>"><br><br>

        <label for="alamat">Alamat: </label><br>
        <input type="text" name="alamat" id="alamat" value="<?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?>"><br><br>
        
        <button type="submit" name="submit" id="submit">Simpan</button>
        <button type="button" onclick="window.location.href='index.php'">Batal</button>
    </form>
    </div>
</body>
</html>