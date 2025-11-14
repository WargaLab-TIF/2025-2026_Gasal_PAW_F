<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Detail</title></head>
<body>
<h2>Tambah Detail Transaksi</h2>
<form method="post">
    Transaksi ID:
    <select name="transaksi_id" required>
        <option value="">--Pilih Transaksi--</option>
        <?php
        $trans = mysqli_query($koneksi, "SELECT * FROM transaksi");
        while ($t = mysqli_fetch_assoc($trans)) {
            echo "<option value='$t[id]'>$t[id] - $t[keterangan]</option>";
        }
        ?>
    </select><br><br>

    Barang:
    <select name="barang_id" required>
        <option value="">--Pilih Barang--</option>
        <?php
        $barang = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($b = mysqli_fetch_assoc($barang)) {
            echo "<option value='$b[id]'>$b[nama_barang]</option>";
        }
        ?>
    </select><br><br>

    Qty: <input type="number" name="qty" required><br><br>

    <input type="submit" name="simpan" value="Simpan">
</form>

<?php
if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // Cek apakah barang sudah ada di detail transaksi
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang ini sudah ditambahkan pada transaksi tersebut!');</script>";
    } else {
        $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'"));
        $harga_total = $barang['harga'] * $qty;

        mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                                VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')");

        // Update total transaksi
        $total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(harga) as total FROM transaksi_detail WHERE transaksi_id='$transaksi_id'"));
        mysqli_query($koneksi, "UPDATE transaksi SET total='{$total['total']}' WHERE id='$transaksi_id'");

        echo "<script>alert('Detail transaksi berhasil ditambahkan!');window.location='index.php';</script>";
    }
}
?>
<br>
<a href="index.php">Kembali</a>
</body>
</html>
