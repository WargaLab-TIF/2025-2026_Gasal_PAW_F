<?php
include 'koneksi.php';

if (isset($_POST['btn_simpan'])) {
    $waktu_transaksi = mysqli_real_escape_string($koneksi, $_POST['waktu_transaksi']); 
    $keterangan = mysqli_real_escape_string($koneksi, trim($_POST['keterangan']));
    $total = 0; 
    $pelanggan_id = mysqli_real_escape_string($koneksi, $_POST['pelanggan_id']);
    $id_user = isset($_SESSION['id_user_login']) ? $_SESSION['id_user_login'] : 1; 

    $tanggal_sekarang = date('Y-m-d');
    $tanggal_input = date('Y-m-d', strtotime($waktu_transaksi)); 

    if ($tanggal_input < $tanggal_sekarang) {
        echo "<script>alert('Tanggal transaksi tidak boleh kurang dari hari ini!');</script>";
    } 
    elseif (strlen($keterangan) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    } 
    elseif (empty($pelanggan_id) || $pelanggan_id == 0) {
        echo "<script>alert('Pilih pelanggan terlebih dahulu!');</script>";
    } 
    else {
        $waktu_insert = $waktu_transaksi;
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, id_user)
                  VALUES ('$waktu_insert', '$keterangan', '$total', '$pelanggan_id', '$id_user')";
        $simpan = mysqli_query($koneksi, $query);

        if ($simpan) {
            $new_id = mysqli_insert_id($koneksi); 
            echo "<script>alert('Data transaksi berhasil disimpan!');
                  window.location='detail_transaksi.php?id=$new_id';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data transaksi! Error: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Transaksi</title>
</head>
<body style="font-family: Arial, sans-serif;">

<table width="100%" bgcolor="black" cellpadding="10">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="transaksi.php"><font color="white" text-decoration="none"><b>&lt; Kembali</b></font></a>
            </font>
        </td>
    </tr>
</table>
<div align="center">
    <h2>Tambah Data Transaksi</h2>
</div>
<div align="center">
    <table border="0" cellpadding="0" cellspacing="0" width="400"> <tr>
            <td>
                <form method="POST" action="">
                    <table border="0" cellpadding="8" cellspacing="0" width="100%">
                        <tr>
                            <td width="35%"><b>Waktu Transaksi</b></td>
                            <td width="65%">
                                <input type="date" name="waktu_transaksi" required width="200" style="width: 200px;">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Keterangan</b></td>
                            <td>
                                <textarea name="keterangan" placeholder="Masukkan keterangan transaksi" required cols="25" rows="4" style="width: 200px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Total</b></td>
                            <td>
                                <input type="number" name="total" value="0" readonly style="width: 200px;">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Pelanggan</b></td>
                            <td>
                                <select name="pelanggan_id" required style="width: 210px;">
                                    <option value="0">-- Pilih Pelanggan --</option>
                                    <?php
                                    $result = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" height="20"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <button type="submit" name="btn_simpan" style="padding: 10px 15px; background-color: limegreen; color: white; text-decoration: none; border-radius: 4px; border-color: limegreen;">
                                    <b>Tambah Transaksi</b>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>
</div>

</body>
</html>