<link rel="stylesheet" href="style.css">
<?php
include 'koneksi.php';

// Ambil data pelanggan untuk dropdown
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];
    $total = 0; // default

    // Validasi tanggal (tidak boleh kurang dari hari ini)
    $today = date('Y-m-d');
    if ($waktu_transaksi < $today) {
        echo "<script>alert('Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
    } 
    // Validasi panjang keterangan minimal 3 karakter
    elseif (strlen($keterangan) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    } 
    else {
        // Simpan data transaksi
        $query = mysqli_query($koneksi, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) 
                                         VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')");
        if ($query) {
            echo "<script>alert('Data transaksi berhasil disimpan!'); window.location='transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data transaksi!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
</head>
<body>
    <h2>Form Tambah Transaksi</h2>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Waktu Transaksi</td>
                <td>
                    <input type="date" name="waktu_transaksi" required 
                           min="<?php echo date('Y-m-d'); ?>">
                </td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>
                    <textarea name="keterangan" rows="3" cols="30" required minlength="3"
                              placeholder="Masukkan keterangan transaksi..."></textarea>
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td>
                    <input type="number" name="total" value="0" readonly>
                </td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>
                    <select name="pelanggan_id" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while($row = mysqli_fetch_assoc($pelanggan)) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="simpan">Tambah Transaksi</button>
                    <a href="transaksi.php">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
