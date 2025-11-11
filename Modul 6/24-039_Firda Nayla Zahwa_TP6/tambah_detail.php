<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$error = "";
$sukses = "";
$result_transaksi = mysqli_query($conn, "SELECT id FROM transaksi");
$result_barang = mysqli_query($conn, "SELECT * FROM barang");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    if (empty($transaksi_id) || empty($barang_id) || empty($qty)) {
        $error = "Semua field wajib diisi!";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail
                                    WHERE transaksi_id='$transaksi_id'
                                    AND barang_id='$barang_id'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Barang ini sudah ditambahkan pada transaksi tersebut!";
        } else {
            $qbarang = mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang_id'");
            $barang = mysqli_fetch_assoc($qbarang);
            $harga_satuan = $barang['harga'];
            $harga_total  = $harga_satuan * $qty;
            $insert = "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                       VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')";
            if (mysqli_query($conn, $insert)) {
                $update_total = "
                    UPDATE transaksi
                    SET total = (
                        SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id'
                    )
                    WHERE id='$transaksi_id'";
                mysqli_query($conn, $update_total);

                $sukses = "Detail transaksi berhasil ditambahkan!";
            } else {
                $error = "Gagal menambahkan detail: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 15px;
            background: #2563eb;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #1e40af;
        }
        .alert {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .error {
            background: #fee2e2;
            color: #b91c1c;
        }
        .success {
            background: #dcfce7;
            color: #166534;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Detail Transaksi</h2>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php elseif ($sukses): ?>
            <div class="alert success"><?= $sukses ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="transaksi_id">Pilih ID Transaksi:</label>
            <select name="transaksi_id" required>
                <option value="">-- Pilih Transaksi --</option>
                <?php while ($row = mysqli_fetch_assoc($result_transaksi)): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['id'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="barang_id">Pilih Barang:</label>
            <select name="barang_id" required>
                <option value="">-- Pilih Barang --</option>
                <?php 
                mysqli_data_seek($result_barang, 0);
                while ($b = mysqli_fetch_assoc($result_barang)): ?>
                    <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?> - Rp<?= number_format($b['harga']) ?></option>
                <?php endwhile; ?>
            </select>

            <label for="qty">Jumlah (Qty):</label>
            <input type="number" name="qty" min="1" required>

            <button type="submit">Simpan Detail</button>
        </form>
    </div>
</body>
</html>
