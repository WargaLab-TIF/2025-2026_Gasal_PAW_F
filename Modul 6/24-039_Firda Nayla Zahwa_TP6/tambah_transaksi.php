<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$error = "";
$sukses = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];
    $user_id = 1;
    $today = date('Y-m-d');

    if ($waktu_transaksi < $today) {
        $error = "Tanggal transaksi tidak boleh sebelum hari ini!";
    } else if (strlen($keterangan) < 3) {
        $error = "Keterangan minimal 3 karakter!";
    } else if (empty($pelanggan_id)) {
        $error = "Pelanggan harus dipilih!";
    } else {
        $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
                VALUES ('$waktu_transaksi', '$keterangan', 0, '$pelanggan_id', '$user_id')";
        if (mysqli_query($conn, $sql)) {
            $sukses = "Data transaksi berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan data: " . mysqli_error($conn);
        }
    }
}

$sql_pelanggan = "SELECT * FROM pelanggan";
$result_pelanggan = mysqli_query($conn, $sql_pelanggan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
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
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[readonly] {
            background: #e9ecef;
            color: #555;
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
        <h2>Tambah Data Transaksi</h2>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php elseif ($sukses): ?>
            <div class="alert success"><?= $sukses ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="waktu_transaksi">Waktu Transaksi:</label>
            <input type="date" name="waktu_transaksi" required>

            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" rows="3" required></textarea>

            <label for="total">Total:</label>
            <input type="number" name="total" value="0" readonly>

            <label for="pelanggan_id">Pilih Pelanggan:</label>
            <select name="pelanggan_id" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php while ($row = mysqli_fetch_assoc($result_pelanggan)): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Simpan Transaksi</button>
        </form>
    </div>
</body>
</html>
