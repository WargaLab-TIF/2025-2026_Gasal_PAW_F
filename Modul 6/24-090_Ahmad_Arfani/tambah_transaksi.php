<?php
include 'koneksi.php';

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
$errors = array();
$errors['waktu'] = '';
$errors['keterangan'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];
    $total = 0;

    if (empty($waktu)) {
        $errors['waktu'] = "Tanggal transaksi harus diisi.";
    } elseif ($waktu < date('Y-m-d')) {
        $errors['waktu'] = "Tanggal transaksi tidak boleh kurang dari hari ini.";
    }

    if (empty($keterangan)) {
        $errors['keterangan'] = "Keterangan harus diisi.";
    } elseif (strlen($keterangan) < 3) {
        $errors['keterangan'] = "Keterangan minimal 3 karakter.";
    }

    if (empty($errors['waktu']) && empty($errors['keterangan'])) {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                  VALUES ('$waktu', '$keterangan', '$total', '$pelanggan_id')";
        $insert = mysqli_query($koneksi, $query);

        if ($insert) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error { color: red; font-size: 14px; margin-top: 3px; }
    </style>
</head>
<body>
    <h2>Tambah Data Transaksi</h2>
    <form method="POST">
        <label>Waktu Transaksi:</label><br>
        <input type="date" name="waktu_transaksi" value="<?= $_POST['waktu_transaksi'] ?? '' ?>">
        <?php if ($errors['waktu'] != ''): ?>
            <div class="error"><?= $errors['waktu']; ?></div>
        <?php endif; ?>
        <br><br>

        <label>Keterangan:</label><br>
        <textarea name="keterangan"><?= $_POST['keterangan'] ?? '' ?></textarea>
        <?php if ($errors['keterangan'] != ''): ?>
            <div class="error"><?= $errors['keterangan']; ?></div>
        <?php endif; ?>
        <br><br>

        <label>Total:</label><br>
        <input type="text" name="total" value="0" readonly><br><br>

        <label>Pelanggan:</label><br>
        <select name="pelanggan_id">
            <option value="">Pilih Pelanggan</option>
            <?php while ($row = mysqli_fetch_assoc($pelanggan)) : ?>
                <option value="<?= $row['id']; ?>" <?= (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $row['id']) ? 'selected' : '' ?>>
                    <?= $row['nama']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <br><br>

        <button type="submit">Tambah Transaksi</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Halaman Utama</a>
</body>
</html>