<?php
include 'koneksi.php';
$data_pelanggan = "SELECT id, nama FROM pelanggan ORDER BY nama";
$query_pelanggan = mysqli_query($koneksi, $data_pelanggan);

if (!$query_pelanggan) {
    die("Error query pelanggan: " . mysqli_error($koneksi));
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Data Transaksi</h2>
        <form action="proses_data_transaksi.php" method="POST">
            <label for="Waktu_Transaksi">Waktu Transaksi:</label>
            <input type="date" id="Waktu_Transaksi" name="Waktu_Transaksi" min="<?php echo date('Y-m-d'); ?>" required>

            <label for="keterangan_transaksi">keterangan:</label>
            <textarea id="keterangan_transaksi" name="keterangan_transaksi" required minlength="3"></textarea>

            <label for="Total_Transaksi">Total:</label>
            <input type="number" id="Total_Transaksi" name="Total_Transaksi" value="0">

            <label for="pelanggan">Pelanggan:</label>
            <select id="pelanggan" name="pelanggan" required>
                <option value="">Pilih Pelanggan</option>
<?php
                while ($DATA = mysqli_fetch_assoc($query_pelanggan)) {
                    echo "<option value='" . $DATA['id'] . "'>" . $DATA['nama'] . "</option>";
                }
?>
            </select>
            <button type="submit">Tambah Transaksi</button>
        </form>
<br>
<a href="index.php" class="button">Kembali</a>
    </div>
</body>
</html>