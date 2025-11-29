<?php
include 'core/conn.php';

// Ambil data transaksi (dropdown)
$transaksi_query = mysqli_query($conn, "
    SELECT t.id, p.nama AS nama_pelanggan 
    FROM transaksi t 
    JOIN pelanggan p ON t.pelanggan_id = p.id
");
$transaksi_data = [];
while ($row = mysqli_fetch_assoc($transaksi_query)) {
    $transaksi_data[] = $row;
}

// Ambil data barang (dropdown)
$barang_query = mysqli_query($conn, "SELECT id, nama_barang, harga FROM barang");
$barang_data = [];
while ($row = mysqli_fetch_assoc($barang_query)) {
    $barang_data[] = $row;
}

// Proses insert detail transaksi
$errors = [];
if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = (int)$_POST['qty'];

    if (empty($transaksi_id) || empty($barang_id) || $qty <= 0) {
        $errors[] = "Semua field wajib diisi dan Qty harus lebih dari 0.";
    } else {
        // Cek apakah barang sudah pernah dimasukkan di transaksi ini
        $cek_barang = mysqli_query($conn, "
            SELECT * FROM transaksi_detail 
            WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'
        ");
        if (mysqli_num_rows($cek_barang) > 0) {
            $errors[] = "Barang ini sudah ada di transaksi tersebut!";
        } else {
            // Ambil harga satuan dari tabel barang
            $barang = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$barang_id'");
            $barang_row = mysqli_fetch_assoc($barang);
            $harga_satuan = $barang_row['harga'];

            // Hitung total harga
            $harga_total = $harga_satuan * $qty;

            // Insert ke transaksi_detail
            $insert = mysqli_query($conn, "
                INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                VALUES ('$transaksi_id', '$barang_id', '$harga_total', '$qty')
            ");

            if ($insert) {
                // Update total di tabel transaksi (akumulasi semua detail)
                mysqli_query($conn, "
                    UPDATE transaksi 
                    SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id')
                    WHERE id = '$transaksi_id'
                ");
                echo "<script>alert('Detail transaksi berhasil ditambahkan!'); window.location='tambah_transaksi_detail.php';</script>";
            } else {
                $errors[] = "Gagal menambahkan data detail transaksi: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f9f9;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #007b83;
        }
        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }
        select, input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }
        button {
            background: #00a896;
            color: white;
            border: none;
            margin-top: 20px;
            font-weight: bold;
        }
        button:hover {
            background: #028090;
        }
        .error {
            background: #ffe5e5;
            color: #d90429;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Detail Transaksi</h2>

    <?php
    if (!empty($errors)) {
        echo "<div class='error'>";
        foreach ($errors as $err) {
            echo "- $err<br>";
        }
        echo "</div>";
    }
    ?>

    <form method="post">
        <label for="transaksi_id">Pilih Transaksi (Nama Pelanggan)</label>
        <select name="transaksi_id" id="transaksi_id" required>
            <option value="">-- Pilih Transaksi --</option>
            <?php foreach ($transaksi_data as $t): ?>
                <option value="<?= $t['id'] ?>">
                    Transaksi #<?= $t['id'] ?> - <?= htmlspecialchars($t['nama_pelanggan']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="barang_id">Pilih Barang</label>
        <select name="barang_id" id="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php foreach ($barang_data as $b): ?>
                <option value="<?= $b['id'] ?>">
                    <?= htmlspecialchars($b['nama_barang']); ?> (Rp<?= number_format($b['harga']); ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="qty">Jumlah Barang (Qty)</label>
        <input type="number" name="qty" id="qty" min="1" required>

        <button type="submit" name="simpan">Simpan Detail</button>
    </form>
</div>
</body>
</html>
