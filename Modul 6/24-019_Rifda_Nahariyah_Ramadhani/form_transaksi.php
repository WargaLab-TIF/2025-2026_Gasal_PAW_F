<?php
include 'koneksi.php';

if (isset($_POST['btn_simpan'])) {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $total = 0; 
    $pelanggan_id = $_POST['pelanggan_id'];

    $tanggal_sekarang = date('Y-m-d');
    if ($waktu_transaksi < $tanggal_sekarang) {
        echo "<script>alert('Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
    } 
    elseif (strlen($keterangan) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    } 
    elseif (empty($pelanggan_id)) {
        echo "<script>alert('Pilih pelanggan terlebih dahulu!');</script>";
    } 
    else {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                  VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
        $simpan = mysqli_query($koneksi, $query);

        if ($simpan) {
            echo "<script>alert('Data transaksi berhasil disimpan!');
                  window.location='detail_transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data transaksi!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Transaksi</title>
</head>
<body style="font-family: Arial; background-color: white; margin: 0; padding: 0;">

<div style="
    width: 420px;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    margin: 50px auto;
">
    <h2 style="text-align:center; color:#333; margin-bottom:20px;">Tambah Data Transaksi</h2>

    <form method="POST" action="" style="display: flex; flex-direction: column;">
        <label style="margin-bottom:5px;"><b>Waktu Transaksi</b></label>
        <input type="date" name="waktu_transaksi" required 
            style="padding:8px; border:1px solid black; border-radius:6px; margin-bottom:15px;">

        <label style="margin-bottom:5px;"><b>Keterangan</b></label>
        <textarea name="keterangan" placeholder="Masukkan keterangan transaksi" required
            style="padding:8px; border:1px solid black; border-radius:6px; height:80px; margin-bottom:15px;"></textarea>

        <label style="margin-bottom:5px;"><b>Total</b></label>
        <input type="number" name="total" value="0" readonly
            style="padding:8px; border:1px solid black; border-radius:6px; margin-bottom:15px; background:#f5f5f5;">

        <label style="margin-bottom:5px;"><b>Pelanggan</b></label>
        <select name="pelanggan_id" required
            style="padding:8px; border:1px solid black; border-radius:6px; margin-bottom:20px;">
            <option value="">-- Pilih Pelanggan --</option>
            <?php
            $result = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
            }
            ?>
        </select>

        <button type="submit" name="btn_simpan"
            style="background-color:blue; color:white; border:none; padding:10px; border-radius:6px; cursor:pointer; font-size: 14px; ">
            <b>Tambah Transaksi</b>
        </button>
    </form>
</div>

</body>
</html>
