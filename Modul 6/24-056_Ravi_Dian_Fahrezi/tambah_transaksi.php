<?php
include "koneksi.php";
require 'validate.php'; // Menggunakan file validasi

$errors = [];

// Ambil data pelanggan untuk dropdown
$sql_pelanggan = "SELECT id, nama FROM pelanggan";
$query_pelanggan = mysqli_query($conn, $sql_pelanggan);
$pelanggan_list = mysqli_fetch_all($query_pelanggan, MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Jalankan validasi
    validateWaktu($_POST, 'waktu_transaksi', $errors);
    validateKeterangan($_POST, 'keterangan', $errors);
    validateDropdown($_POST, 'pelanggan_id', 'Pelanggan harus dipilih.', $errors);

    if (empty($errors)) {
        $waktu_transaksi = $_POST["waktu_transaksi"];
        $keterangan = mysqli_real_escape_string($conn, $_POST["keterangan"]);
        $pelanggan_id = (int)$_POST["pelanggan_id"];
        $total = 0; // Total awal default 0

        $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) 
                    VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Transaksi</title>
    <link rel="stylesheet" href="css/inputStyle.css">
    <style>
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 6px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
    </style>
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
            <h2>Tambah Data Transaksi</h2>
            <label for="waktu_transaksi">Waktu Transaksi:</label>
            <input type="date" name="waktu_transaksi" id="waktu_transaksi"
                value="<?= htmlspecialchars($_POST['waktu_transaksi'] ?? date('Y-m-d')) ?>">

            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan" rows="3"><?= htmlspecialchars($_POST['keterangan'] ?? '') ?></textarea>

            <label for="pelanggan_id">Pelanggan:</label>
            <select name="pelanggan_id" id="pelanggan_id">
                <option value="">Pilih Pelanggan</option>
                <?php foreach ($pelanggan_list as $pelanggan): ?>
                    <option value="<?= $pelanggan['id'] ?>" <?= (($_POST['pelanggan_id'] ?? '') == $pelanggan['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($pelanggan['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="submit">Simpan</button>
            <button type="button" onclick="window.location.href='index.php'">Batal</button>
        </form>
    </div>
</body>

</html>