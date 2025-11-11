<?php

include 'koneksi.php';

$sqlPelanggan = "SELECT id, nama FROM pelanggan ORDER BY nama ASC";
$pelanggan_result = mysqli_query($conn, $sqlPelanggan); 

$pesan_sukses = "";
$error = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $total = 0; 
    $pelanggan_id = $_POST['pelanggan_id'];

 
    if ($waktu_transaksi < date('Y-m-d')) {
        $error = "Tanggal transaksi tidak boleh kurang dari hari ini.";
    }
  
    elseif (strlen($keterangan) < 3) {
        $error = "Keterangan minimal 3 karakter.";
    }
   
    elseif (empty($pelanggan_id)) {
        $error = "Pelanggan harus dipilih.";
    } else {
        
        $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) 
        VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
        $simpan = mysqli_query($conn, $sql);
        if ($simpan) {
            $pesan_sukses = "Transaksi berhasil ditambahkan.";
            $waktu_transaksi = "";
            $keterangan = "";
            $pelanggan_id = "";
        } else {
            $error = "Gagal menambahkan transaksi: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Transaksi</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f7f9fc;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-container {
    width: 340px;
    background: #fff;
    padding: 24px 28px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

h2 {
    text-align: center;
    margin-bottom: 22px;
    font-weight: 700;
    color: #222;
    font-size: 18px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

input[type="date"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

input[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

button:hover {
    background-color: #0056b3;
}

.message {
    font-weight: 600;
    padding: 10px 14px;
    margin-bottom: 18px;
    border-radius: 8px;
    text-align: center;
}

.error {
    background-color: #f8d7da;
    color: #842029;
}

.success {
    background-color: #d1e7dd;
    color: #0f5132;
}

    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Data Transaksi</h2>

    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($pesan_sukses): ?>
        <div class="message success"><?= htmlspecialchars($pesan_sukses) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="waktuTransaksi">Waktu Transaksi</label>
        <input type="date" id="waktuTransaksi" name="waktu_transaksi" 
        min="<?= date('Y-m-d') ?>" required value="<?= isset($waktu_transaksi) ? htmlspecialchars($waktu_transaksi) : '' ?>"
        />

        <label for="keterangan">Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="3" minlength="3" 
        placeholder="Masukkan keterangan transaksi" required><?= isset($keterangan) ? htmlspecialchars($keterangan) : '' ?></textarea>

        <label for="total">Total</label>
        <input type="number" id="total" name="total"value="0" 
        />

        <label for="pelanggan">Pilih Pelanggan</label>
        <select id="pelanggan" name="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php 
            while ($p = mysqli_fetch_array($pelanggan_result)) {
                $selected = (isset($pelanggan_id) && $pelanggan_id == $p['id']) ? 'selected' : '';
                echo "<option value='{$p['id']}' $selected>{$p['nama']}</option>";
            }
            ?>
        </select>

        <button type="submit">Tambah Transaksi</button>
    </form>
</div>

</body>
</html>