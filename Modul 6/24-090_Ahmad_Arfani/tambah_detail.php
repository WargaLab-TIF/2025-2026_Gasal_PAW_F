<?php
include 'koneksi.php';

$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");

$errors = array();
$errors['barang_id'] = '';
$errors['transaksi_id'] = '';
$errors['qty'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = $_POST['barang_id'];
    $transaksi_id = $_POST['transaksi_id'];
    $qty = $_POST['qty'];

    if (empty($barang_id)) {
        $errors['barang_id'] = "Silakan pilih barang terlebih dahulu.";
    }

    if (empty($transaksi_id)) {
        $errors['transaksi_id'] = "Silakan pilih ID transaksi.";
    }

    if (empty($qty) || $qty <= 0) {
        $errors['qty'] = "Jumlah (Qty) harus lebih dari 0.";
    }

    if (empty($errors['barang_id']) && empty($errors['transaksi_id'])) {
        $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
        if (mysqli_num_rows($cek) > 0) {
            $errors['barang_id'] = "Barang ini sudah ditambahkan ke transaksi tersebut.";
        }
    }

    if (empty($errors['barang_id']) && empty($errors['transaksi_id']) && empty($errors['qty'])) {
        $data_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'"));
        $harga_satuan = $data_barang['harga'];
        $harga_total = $harga_satuan * $qty;

        $insert = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')");

        if ($insert) {
            $update_total = mysqli_query($koneksi, "
                UPDATE transaksi 
                SET total = (
                    SELECT SUM(harga)
                    FROM transaksi_detail
                    WHERE transaksi_id = '$transaksi_id'
                )
                WHERE id = '$transaksi_id'
            ");
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($koneksi);
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
    <h2>Tambah Detail Transaksi</h2>
    <form method="POST">
        <label>Pilih Barang:</label><br>
        <select name="barang_id">
            <option value="">Pilih Barang</option>
            <?php mysqli_data_seek($barang, 0); while ($b = mysqli_fetch_assoc($barang)) : ?>
                <option value="<?= $b['id'] ?>" <?= (isset($_POST['barang_id']) && $_POST['barang_id'] == $b['id']) ? 'selected' : '' ?>>
                    <?= $b['nama_barang'] ?> (Rp <?= number_format($b['harga'], 0, ',', '.') ?>)
                </option>
            <?php endwhile; ?>
        </select>
        <?php if ($errors['barang_id']): ?>
            <div class="error"><?= $errors['barang_id'] ?></div>
        <?php endif; ?>
        <br><br>

        <label>Pilih ID Transaksi:</label><br>
        <select name="transaksi_id">
            <option value="">Pilih ID Transaksi</option>
            <?php mysqli_data_seek($transaksi, 0); while ($t = mysqli_fetch_assoc($transaksi)) : ?>
                <option value="<?= $t['id'] ?>" <?= (isset($_POST['transaksi_id']) && $_POST['transaksi_id'] == $t['id']) ? 'selected' : '' ?>>
                    ID: <?= $t['id'] ?> - <?= $t['keterangan'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <?php if ($errors['transaksi_id']): ?>
            <div class="error"><?= $errors['transaksi_id'] ?></div>
        <?php endif; ?>
        <br><br>

        <label>Quantity:</label><br>
        <input type="number" name="qty" placeholder="Masukkan jumlah barang" min="1" value="<?= $_POST['qty'] ?? '' ?>">
        <?php if ($errors['qty']): ?>
            <div class="error"><?= $errors['qty'] ?></div>
        <?php endif; ?>
        <br><br>

        <button type="submit">Tambah Detail Transaksi</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Halaman Utama</a>
</body>
</html>