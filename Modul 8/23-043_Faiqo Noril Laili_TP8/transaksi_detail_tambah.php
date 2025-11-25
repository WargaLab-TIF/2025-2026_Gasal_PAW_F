<link rel="stylesheet" href="style.css">
<?php
include 'koneksi.php';


// Ambil data transaksi untuk dropdown
$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id DESC");
// Ambil data barang untuk dropdown
$barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama_barang ASC");

// Proses simpan data detail transaksi
if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // Cek apakah barang sudah pernah ditambahkan pada transaksi ini
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang ini sudah ditambahkan pada transaksi ini!');</script>";
    } else {
        // Ambil harga barang dari tabel barang
        $data_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'"));
        $harga = $data_barang['harga'];
        $subtotal = $qty * $harga;

        // Simpan ke tabel transaksi_detail
        $query = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, subtotal)
                                         VALUES ('$transaksi_id', '$barang_id', '$qty', '$subtotal')");

        if ($query) {
            // Update total di tabel transaksi
            mysqli_query($koneksi, "UPDATE transaksi 
                                    SET total = total + $subtotal 
                                    WHERE id = '$transaksi_id'");
            echo "<script>alert('Detail transaksi berhasil disimpan!'); window.location='transaksi_detail_tambah.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan detail transaksi!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Transaksi</title>
</head>
<body>
    <h2>Form Tambah Detail Transaksi</h2>

    <form action="" method="POST">
        <table>
            <tr>
                <td>Transaksi</td>
                <td>
                    <select name="transaksi_id" required>
                        <option value="">-- Pilih Transaksi --</option>
                        <?php while($t = mysqli_fetch_assoc($transaksi)) { ?>
                            <option value="<?= $t['id'] ?>">ID <?= $t['id'] ?> - <?= $t['keterangan'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Barang</td>
                <td>
                    <select name="barang_id" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php while($b = mysqli_fetch_assoc($barang)) { ?>
                            <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?> (Rp<?= number_format($b['harga']) ?>)</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Qty</td>
                <td><input type="number" name="qty" min="1" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="simpan">Simpan</button>
                    <a href="transaksi.php">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
