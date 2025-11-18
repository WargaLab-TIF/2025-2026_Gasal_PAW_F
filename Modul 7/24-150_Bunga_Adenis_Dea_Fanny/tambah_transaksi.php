<?php
include 'koneksi.php';

// ambil daftar pelanggan untuk dropdown
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");

// proses simpan
if (isset($_POST['simpan'])) {

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelanggan_id = $_POST['pelanggan_id'];

    $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
              VALUES ('$tanggal', '$keterangan', '$total', '$pelanggan_id')";

    mysqli_query($conn, $query);

    // kembali ke halaman transaksi
    header("Location: transaksi.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>

<h2>Form Tambah Transaksi</h2>

<a href="transaksi.php">Kembali</a>
<br><br>

<form method="POST">

    Tanggal Transaksi:<br>
    <input type="date" name="tanggal" required><br><br>

    Keterangan:<br>
    <input type="text" name="keterangan" required><br><br>

    Total:<br>
    <input type="number" name="total" required><br><br>

    Pelanggan:<br>
    <select name="pelanggan_id" required>
        <option value="">-- Pilih Pelanggan --</option>

        <?php while ($row = mysqli_fetch_assoc($pelanggan)) { ?>
            <option value="<?= $row['id']; ?>">
                <?= $row['id']; ?> - <?= $row['nama']; ?>
            </option>
        <?php } ?>

    </select>

    <br><br>

    <button type="submit" name="simpan">Simpan</button>

</form>

</body>
</html>
