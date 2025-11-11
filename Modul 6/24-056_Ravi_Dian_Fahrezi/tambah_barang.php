<?php
include "koneksi.php";
require 'validate.php'; // Menggunakan file validasi

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Jalankan validasi
    validateNamaBarang($_POST, 'nama', $errors);
    validateHarga($_POST, 'harga_satuan', $errors);

    // Cek duplikat (jika nama valid)
    if (isset($_POST["nama"]) && empty($errors['nama'])) {
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]); // Escaping sederhana
        $sql_cek = "SELECT id FROM barang WHERE nama = '$nama'";
        $query_cek = mysqli_query($conn, $sql_cek);
        if (mysqli_num_rows($query_cek) > 0) {
            $errors['nama'] = "Nama barang '$nama' sudah ada di database!";
        }
    }

    // Kalau tidak ada error
    if (empty($errors)) {
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $harga = (int)$_POST["harga_satuan"];

        // Insert data (Gaya sederhana Anda)
        $sql = "INSERT INTO barang (nama, harga_satuan) VALUES ('$nama', '$harga')";

        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
            exit;
        } else {
            $errors['db'] = "Gagal menyimpan ke database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="css/inputStyle.css">
</head>

<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="error-container">
                <h4>Terjadi kesalahan</h4>
                <?php foreach ($errors as $errorMsg): ?>
                    <p><?= htmlspecialchars($errorMsg) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <h2>Tambah Data Barang</h2>
            <label for="nama">Nama Barang:</label>
            <input type="text" name="nama" id="nama"
                value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">

            <label for="harga_satuan">Harga Satuan:</label>
            <input type="text" name="harga_satuan" id="harga_satuan"
                value="<?= htmlspecialchars($_POST['harga_satuan'] ?? '') ?>">

            <button type="submit" name="submit">Simpan</button>
            <button type="button" onclick="window.location.href='index.php'">Batal</button>
        </form>
    </div>
</body>

</html>