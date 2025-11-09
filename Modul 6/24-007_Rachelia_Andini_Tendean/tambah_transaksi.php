<?php
include 'koneksi.php';

// Ambil data pelanggan untuk dropdown
$pelangganData = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama ASC");

if (isset($_POST['simpan'])) {
    $tanggal   = $_POST['tgl'];
    $keterangan = trim($_POST['ket']);
    $pelanggan  = $_POST['pel'];

    $pesanError = [];

    // Validasi tanggal
    if ($tanggal < date('Y-m-d')) {
        $pesanError[] = "Tanggal tidak boleh sebelum hari ini.";
    }

    // Validasi keterangan
    if (strlen($keterangan) < 3) {
        $pesanError[] = "Keterangan minimal 3 karakter.";
    }

    // Validasi pelanggan
    if (empty($pelanggan)) {
        $pesanError[] = "Pelanggan harus dipilih.";
    }

    // Jika semua valid
    if (empty($pesanError)) {
        $simpan = mysqli_query($conn, "
            INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
            VALUES ('$tanggal', '$keterangan', 0, '$pelanggan')
        ");

        if ($simpan) {
            echo "<script>
                    alert('Transaksi berhasil disimpan!');
                    window.location='tambah_detail.php';
                  </script>";
        } else {
            echo "<script>alert('Gagal menyimpan transaksi!');</script>";
        }
    } else {
        // Tampilkan semua pesan error
        foreach ($pesanError as $pesan) {
            echo "<script>alert('$pesan');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f7fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .form-box {
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        width: 360px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
        color: #555;
    }
    input, textarea, select {
        width: 100%;
        padding: 8px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }
    textarea { height: 70px; }
    input[readonly] {
        background: #f1f1f1;
        font-weight: bold;
        color: #333;
    }
    button {
        width: 100%;
        background: #007bff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        margin-top: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover { background: #0056b3; }
</style>
</head>
<body>

<div class="form-box">
    <h2>Tambah Transaksi</h2>
    <form method="POST">
        <label>Tanggal Transaksi</label>
        <input type="date" name="tgl" required>

        <label>Keterangan</label>
        <textarea name="ket" placeholder="Masukkan keterangan transaksi" required></textarea>

        <label>Total</label>
        <input type="number" name="total" value="0" readonly>

        <label>Pelanggan</label>
        <select name="pel" required>
            <option value="">Pilih Pelanggan</option>
            <?php while ($p = mysqli_fetch_assoc($pelangganData)) { ?>
                <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="simpan">Simpan Transaksi</button>
    </form>
</div>

</body>
</html>
