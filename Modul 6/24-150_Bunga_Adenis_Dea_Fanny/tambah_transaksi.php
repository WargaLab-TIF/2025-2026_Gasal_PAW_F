<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Transaksi</title></head>
<body>
<h2>Tambah Transaksi</h2>
<form method="post">
    Waktu Transaksi: <input type="date" name="tanggal" required><br><br>
    Keterangan: <textarea name="keterangan" required></textarea><br><br>
    Pelanggan ID: 
    <select name="pelanggan_id" required>
        <option value="">--Pilih Pelanggan--</option>
        <?php
        $pel = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($p = mysqli_fetch_assoc($pel)) {
            echo "<option value='$p[id]'>$p[nama]</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" name="simpan" value="Simpan">
</form>

<?php
if (isset($_POST['simpan'])) {
    $tgl = $_POST['tanggal'];
    $ket = $_POST['keterangan'];
    $pelanggan = $_POST['pelanggan_id'];

    if ($tgl < date('Y-m-d')) {
        echo "<script>alert('Tanggal tidak boleh kurang dari hari ini!');</script>";
    } elseif (strlen($ket) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    } else {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                  VALUES ('$tgl', '$ket', 0, '$pelanggan')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Transaksi berhasil disimpan!');window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambah transaksi!');</script>";
        }
    }
}
?>
<br>
<a href="index.php">Kembali</a>
</body>
</html>
