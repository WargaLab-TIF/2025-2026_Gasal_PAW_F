<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // Cek apakah barang sudah ada di transaksi_detail
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang sudah ada di detail transaksi ini');history.back();</script>";
        exit;
    }

    // Ambil harga satuan barang
    $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'"));
    $harga_total = $barang['harga'] * $qty;

    // Insert detail transaksi
    mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                            VALUES ('$transaksi_id', '$barang_id', '$harga_total', '$qty')");

    // Update total transaksi otomatis
    mysqli_query($koneksi, "
        UPDATE transaksi 
        SET total = (
            SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id'
        )
        WHERE id='$transaksi_id'
    ");

    echo "<script>alert('Detail transaksi berhasil ditambahkan');window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 320px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        label {
            display: block;
            margin-top: 8px;
        }
        input, select {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 10px;
            background-color: green;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
<h3>Tambah Detail Transaksi</h3>
<form method="post">
    <label>ID Transaksi</label>
    <select name="transaksi_id" required>
        <option value="">-- Pilih Transaksi --</option>
        <?php
        $t = mysqli_query($koneksi, "SELECT * FROM transaksi");
        while ($tr = mysqli_fetch_assoc($t)) {
            echo "<option value='{$tr['id']}'>Transaksi ID {$tr['id']} - {$tr['keterangan']}</option>";
        }
        ?>
    </select>

    <label>Barang</label>
    <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>
        <?php
        $b = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($br = mysqli_fetch_assoc($b)) {
            echo "<option value='{$br['id']}'>{$br['nama_barang']} (Rp {$br['harga']})</option>";
        }
        ?>
    </select>

    <label>Qty</label>
    <input type="number" name="qty" min="1" required>

    <button type="submit">Simpan</button>
</form>
</body>
</html>
