<?php
include "koneksi.php";
require 'validate.php'; // Menggunakan file validasi

$errors = [];

// Ambil data barang untuk dropdown
$sql_barang = "SELECT id, nama, harga_satuan FROM barang";
$query_barang = mysqli_query($conn, $sql_barang);
$barang_list = mysqli_fetch_all($query_barang, MYSQLI_ASSOC);

// Ambil data transaksi untuk dropdown
$sql_transaksi = "SELECT id FROM transaksi ORDER BY id DESC";
$query_transaksi = mysqli_query($conn, $sql_transaksi);
$transaksi_list = mysqli_fetch_all($query_transaksi, MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Jalankan validasi
    validateDropdown($_POST, 'transaksi_id', 'ID Transaksi harus dipilih.', $errors);
    validateDropdown($_POST, 'barang_id', 'Barang harus dipilih.', $errors);
    validateQty($_POST, 'qty', $errors);

    $transaksi_id = $_POST["transaksi_id"] ?? null;
    $barang_id = $_POST["barang_id"] ?? null;

    // Validasi: Cek duplikat barang (sesuai modul)
    if (!empty($transaksi_id) && !empty($barang_id)) {
        $sql_cek = "SELECT id FROM transaksi_detail WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'";
        $query_cek = mysqli_query($conn, $sql_cek);
        if (mysqli_num_rows($query_cek) > 0) {
            $errors['barang_id'] = "Barang sudah ada di detail transaksi ini.";
        }
    }

    // Jika tidak ada error
    if (empty($errors)) {
        $qty = (int)$_POST["qty"];

        // 1. Ambil harga satuan barang
        $sql_harga = "SELECT harga_satuan FROM barang WHERE id = '$barang_id'";
        $query_harga = mysqli_query($conn, $sql_harga);
        $harga_satuan = (int)mysqli_fetch_assoc($query_harga)['harga_satuan'];

        // Hitung harga total untuk detail ini
        $harga_total_barang = $harga_satuan * $qty;

        // 2. Insert ke transaksi_detail
        $sql_insert = "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) 
                           VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total_barang')";

        if (mysqli_query($conn, $sql_insert)) {

            // 3. Update total di tabel transaksi (Master)
            // Ini adalah query kedua yang dijalankan
            $sql_update_total = "UPDATE transaksi 
                                     SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id') 
                                     WHERE id = '$transaksi_id'";

            if (mysqli_query($conn, $sql_update_total)) {
                // Jika KEDUA query berhasil
                header("Location: index.php");
                exit;
            } else {
                $errors[] = "Gagal mengupdate total master.";
            }
        } else {
            $errors[] = "Gagal menyimpan detail transaksi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="css/inputStyle.css">
    <style>
        input[type="text"],
        input[type="number"],
        select {
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
            <h2>Tambah Detail Transaksi</h2>

            <label for="transaksi_id">Pilih ID Transaksi:</label>
            <select name="transaksi_id" id="transaksi_id">
                <option value="">Pilih ID Transaksi</option>
                <?php foreach ($transaksi_list as $transaksi): ?>
                    <option value="<?= $transaksi['id'] ?>" <?= (($_POST['transaksi_id'] ?? '') == $transaksi['id']) ? 'selected' : '' ?>>
                        ID: <?= $transaksi['id'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="barang_id">Pilih Barang:</label>
            <select name="barang_id" id="barang_id">
                <option value="">Pilih Barang</option>
                <?php foreach ($barang_list as $barang): ?>
                    <option value="<?= $barang['id'] ?>" <?= (($_POST['barang_id'] ?? '') == $barang['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($barang['nama']) ?> (Rp <?= number_format($barang['harga_satuan']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="qty">Quantity:</label>
            <input type="text" name="qty" id="qty" value="<?= htmlspecialchars($_POST['qty'] ?? 1) ?>">

            <button type="submit" name="submit">Simpan</button>
            <button type="button" onclick="window.location.href='index.php'">Batal</button>
        </form>
    </div>
</body>

</html>