<?php
include "koneksi.php";

if(isset($_POST['simpan'])){
    $tgl = $_POST['tanggal'];
    $ket = $_POST['keterangan'];
    $pel = $_POST['pelanggan'];
    $total = $_POST['total'];

    mysqli_query($conn,"INSERT INTO transaksi(waktu_transaksi, keterangan, total, pelanggan_id)
        VALUES('$tgl','$ket','$total','$pel')");

    echo "<script>alert('Data berhasil ditambahkan');window.location='master.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <link rel='stylesheet' href='assets/style.css'>
</head>
<body>

<h2>Tambah Transaksi</h2>

<form method="POST">
    <label>Tanggal</label><br>
    <input type="date" name="tanggal" required><br><br>

    <label>Keterangan</label><br>
    <textarea name="keterangan" required></textarea><br><br>

    <label>Pelanggan</label><br>
    <select name="pelanggan" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php
        $pel = mysqli_query($conn,"SELECT * FROM pelanggan");
        while($p = mysqli_fetch_assoc($pel)){
            echo "<option value='$p[id]'>$p[nama]</option>";
        }
        ?>
    </select><br><br>

    <label>Total Transaksi</label><br>
    <input type="number" name="total" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="master.php" class="button">Kembali</a>
</form>

</body>
</html>
