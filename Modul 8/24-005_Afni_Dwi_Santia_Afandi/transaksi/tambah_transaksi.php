<?php
include "../cek_login.php";
include "../koneksi.php";

// ambil data pelanggan untuk dropdown
$pelanggan = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan");

$pesan = "";

if (isset($_POST['simpan'])) {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $total = 0; 
    $pelanggan_id = $_POST['pelanggan_id'];


    $tanggal_sekarang = date('Y-m-d');
    if ($waktu_transaksi < $tanggal_sekarang) {
        $pesan = "Tanggal transaksi tidak boleh sebelum hari ini!";
    }
    
    elseif (strlen($keterangan) < 3) {
        $pesan = "Keterangan minimal 3 karakter!";
    }
    
    // validasi dropdown pelanggan
    elseif ($pelanggan_id == "") {
        $pesan = "Pelanggan harus dipilih!";
    } else {
        // simpan ke tabel transaksi
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                  VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data transaksi berhasil disimpan!";
        } else {
            $pesan = "Gagal menyimpan data: " . mysqli_error($koneksi);
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
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 20px;">

<div style="width: 450px; margin: auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
    <h2 style="text-align: center; margin-bottom: 20px;">Tambah Data Transaksi</h2>
    
    <?php if ($pesan != "") { ?>
        <div style="text-align: center; margin-bottom: 15px; color: red; font-weight: bold;">
            <?= $pesan ?>
        </div>
    <?php } ?>

    <form method="POST">
        <label style="display: block; margin-top: 10px;">Waktu Transaksi:</label>
        <input type="date" name="waktu_transaksi" required
               style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 10px;">

        <label style="display: block;">Keterangan:</label>
        <textarea name="keterangan" placeholder="Masukkan keterangan transaksi" rows="3" required
                  style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 10px;"></textarea>

        <label style="display: block;">Total:</label>
        <input type="number" name="total" value="0" readonly
               style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 10px; background-color: #eee;">

        <label style="display: block;">Pelanggan:</label>
        <select name="pelanggan_id" required
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 15px;">
            <option value=""> Pilih Pelanggan </option>
            <?php while ($row = mysqli_fetch_assoc($pelanggan)) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="simpan"
                style="background-color: #4CAF50; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer;">
            Tambah Transaksi
        </button>
        <a href="transaksi.php"
        style="
                display:block;
                width:100%;
                box-sizing:border-box;
                padding:10px;
                margin-top:10px;
                text-align:center;
                background:#FEC8D8;
                color:purple;
                border-radius:5px;
                text-decoration:none;
                cursor:pointer;
        ">
            Kembali
        </a>


    </form>
</div>

</body>
</html>
