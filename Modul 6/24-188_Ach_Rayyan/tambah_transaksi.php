<?php
$conn = mysqli_connect("localhost", "root", "", "master-detail");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$today  = date('Y-m-d');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waktu        = $_POST['waktu_transaksi'] ?? '';
    $keterangan   = trim($_POST['keterangan'] ?? '');
    $pelanggan_id = intval($_POST['pelanggan_id'] ?? 0);

    if ($waktu == '') {
        $errors[] = "Tanggal wajib diisi.";
    } elseif ($waktu < $today) {
        $errors[] = "Tanggal tidak boleh sebelum hari ini.";
    }

    if (strlen($keterangan) < 3) {
        $errors[] = "Keterangan minimal 3 karakter.";
    }

    if ($pelanggan_id <= 0) {
        $errors[] = "Pilih pelanggan.";
    }

    if (empty($errors)) {
        $waktu_esc = mysqli_real_escape_string($conn, $waktu);
        $ket_esc   = mysqli_real_escape_string($conn, $keterangan);

        $sql = "
            INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
            VALUES ('$waktu_esc', '$ket_esc', 0, $pelanggan_id)
        ";

        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn);
            header("Location: tambah_detail.php?transaksi_id=$id");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data.";
        }
    }
}
// ngambil data buat di dropdown
$pelanggan = mysqli_query($conn, "SELECT id, nama FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tambah Transaksi</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
        }
        .container {
            width: 360px;
            margin: 30px auto;
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        h3 {
            text-align: center;
            margin: 0;
        }
        label {
            display: block;
            margin-top: 8px;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            box-sizing: border-box;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .errors {
            color: red;
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Tambah Data Transaksi</h3>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $e) echo htmlspecialchars($e) . "<br>"; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <label>Waktu Transaksi</label>
            <input 
                type="date" 
                name="waktu_transaksi" 
                min="<?= $today ?>" 
                value="<?= htmlspecialchars($_POST['waktu_transaksi'] ?? '') ?>"
            >

            <label>Keterangan</label>
            <textarea 
                name="keterangan" 
                placeholder="Masukkan keterangan transaksi"
            ><?= htmlspecialchars($_POST['keterangan'] ?? '') ?></textarea>

            <label>Total</label>
            <input type="text" value="0" readonly>

            <label>Pelanggan</label>
            <select name="pelanggan_id">
                <option value="">Pilih Pelanggan</option>
                <?php while ($r = mysqli_fetch_assoc($pelanggan)): ?>
                    <option 
                        value="<?= $r['id'] ?>" 
                        <?= (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id'] == $r['id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($r['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Tambah Transaksi</button>
        </form>
    </div>
</body>
</html>
