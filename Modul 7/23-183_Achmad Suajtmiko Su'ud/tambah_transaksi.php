<?php
include 'koneksi.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelanggan_id = $_POST['pelanggan_id'];
    $user_id = 1; 

    $stmt = $koneksi->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisi", $waktu_transaksi, $keterangan, $total, $pelanggan_id, $user_id);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Transaksi berhasil ditambahkan! (Detail barang perlu ditambahkan secara terpisah).</div>";
    } else {
        $message = "<div class='alert alert-danger'>Gagal menambahkan transaksi: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

$result_pelanggan = $koneksi->query("SELECT id, nama FROM pelanggan");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="content-container" style="max-width: 600px;">
        <h2>Tambah Transaksi Baru</h2>
        <?php echo $message; ?>

        <form method="post" action="tambah_transaksi.php">
            <div class="form-group">
                <label>Tanggal Transaksi:</label>
                <input type="date" name="waktu_transaksi" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label>Pelanggan:</label>
                <select name="pelanggan_id" class="form-control" required>
                    <?php while ($p = $result_pelanggan->fetch_assoc()): ?>
                        <option value="<?php echo $p['id']; ?>"><?php echo $p['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan:</label>
                <textarea name="keterangan" class="form-control">Self pickup</textarea>
            </div>
            <div class="form-group">
                <label>Total:</label>
                <input type="number" name="total" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>

            <a href="data_master_transaksi.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>