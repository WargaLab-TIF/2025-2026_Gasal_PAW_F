<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "store");

// cek koneksi
if (!$koneksi) {
    echo ("Koneksi gagal: " . mysqli_connect_error());
}

// ambil data transaksi dan barang
$transaksi = mysqli_query($koneksi, "SELECT id, keterangan FROM transaksi");
$barang = mysqli_query($koneksi, "SELECT id, nama_barang, harga FROM barang");

// inisialisasi pesan
$pesan = "";

// jika form disubmit
if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // validasi sederhana
    if ($transaksi_id == "" || $barang_id == "" || $qty == "") {
        $pesan = "Semua field harus diisi!";
    } elseif ($qty <= 0) {
        $pesan = "Quantity harus lebih dari 0!";
    } else {
        // cek apakah transaksi_id sudah ada di tabel transaksi_detail
        $cekTransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id'");
        $dataAda = mysqli_fetch_assoc($cekTransaksi);

        // ambil harga satuan barang
        $data_barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga FROM barang WHERE id='$barang_id'"));
        $harga_satuan = $data_barang['harga'];
        $total_harga = $harga_satuan * $qty;

        if ($dataAda) {
            // jika transaksi_id sudah ada -> update data lama
            $update = "UPDATE transaksi_detail 
                       SET barang_id='$barang_id', harga='$total_harga', qty='$qty' 
                       WHERE transaksi_id='$transaksi_id'";
            $hasil = mysqli_query($koneksi, $update);

            if ($hasil) {
                $pesan = "Data transaksi detail berhasil diperbarui!";
            } else {
                $pesan = "Gagal memperbarui data!";
            }
        } else {
            // jika transaksi_id belum ada -> insert baru
            $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                      VALUES ('$transaksi_id', '$barang_id', '$total_harga', '$qty')";
            $hasil = mysqli_query($koneksi, $query);

            if ($hasil) {
                $pesan = "Detail transaksi berhasil disimpan!";
            } else {
                $pesan = "Gagal menyimpan data!";
            }
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
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 20px;">

<div style="width: 450px; margin: auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px #ccc;">
    <h2 style="text-align: center; margin-bottom: 20px;">Tambah Detail Transaksi</h2>

    <?php if ($pesan != "") { ?>
        <div style="text-align: center; margin-bottom: 15px; color: red; font-weight: bold;">
            <?= $pesan ?>
        </div>
    <?php } ?>

    <form method="POST">
        <label style="display: block; margin-top: 10px;">Pilih Barang:</label>
        <select name="barang_id" required
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 10px;">
            <option value="">Pilih Barang</option>
            <?php
            mysqli_data_seek($barang, 0); // reset pointer data
            while ($b = mysqli_fetch_assoc($barang)) { ?>
                <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?></option>
            <?php } ?>
        </select>

        <label style="display: block;">ID Transaksi:</label>
        <select name="transaksi_id" required
                style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 10px;">
            <option value="">Pilih ID Transaksi</option>
            <?php
            mysqli_data_seek($transaksi, 0);
            while ($t = mysqli_fetch_assoc($transaksi)) { ?>
                <option value="<?= $t['id'] ?>"><?= $t['id'] ?> - <?= $t['keterangan'] ?></option>
            <?php } ?>
        </select>

        <label style="display: block;">Quantity:</label>
        <input type="number" name="qty" placeholder="Masukkan jumlah barang" required
               style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #aaa; margin-bottom: 15px;">

        <button type="submit" name="simpan"
                style="background-color: #4CAF50; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer;">
            Tambah Detail Transaksi
        </button>
    </form>
</div>

</body>
</html>
