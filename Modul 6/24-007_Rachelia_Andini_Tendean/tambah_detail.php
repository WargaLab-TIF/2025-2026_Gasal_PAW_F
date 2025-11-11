<?php
include 'koneksi.php';

// Ambil data transaksi dan barang
$transList = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");
$barangList = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

if (isset($_POST['simpan'])) {
    $transId  = $_POST['trans'];
    $barangId = $_POST['barang'];
    $qty      = $_POST['qty'];

    // Cek apakah barang sudah ada di transaksi ini
    $cekBarang = mysqli_query($conn, "
        SELECT * FROM transaksi_detail 
        WHERE transaksi_id = '$transId' AND barang_id = '$barangId'
    ");

    if (mysqli_num_rows($cekBarang) > 0) {
        echo "<script>alert('Barang ini sudah ada pada transaksi tersebut!');</script>";
    } else {
        // Ambil harga barang
        $barangData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barangId'"));
        $hargaSatuan = $barangData['harga'];
        $totalHarga  = $hargaSatuan * $qty;

        // Simpan ke tabel transaksi_detail
        $simpanDetail = mysqli_query($conn, "
            INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
            VALUES ('$transId', '$barangId', '$totalHarga', '$qty')
        ");

        if ($simpanDetail) {
            // Update total transaksi di tabel transaksi
            mysqli_query($conn, "
                UPDATE transaksi 
                SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transId')
                WHERE id='$transId'
            ");

            echo "<script>
                    alert('Detail transaksi berhasil disimpan!');
                    window.location='tambah_detail.php';
                  </script>";
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
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 30px; }
        form { background: white; padding: 20px; border-radius: 10px; width: 400px; margin: auto; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
        button { background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        h2 { text-align: center; color: #333; }
        .btn-center { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <h2>Tambah Detail Transaksi</h2>

    <form method="POST">
        <label>Barang</label>
        <select name="barang" required>
            <option value="">Pilih Barang</option>
            <?php while ($brg = mysqli_fetch_assoc($barangList)) { ?>
                <option value="<?= $brg['id']; ?>">
                    <?= $brg['nama_barang']; ?> - Rp<?= number_format($brg['harga'], 0, ',', '.'); ?>
                </option>
            <?php } ?>
        </select>

        <label>ID Transaksi</label>
        <select name="trans" required>
            <option value="">Pilih Transaksi</option>
            <?php while ($trs = mysqli_fetch_assoc($transList)) { ?>
                <option value="<?= $trs['id']; ?>">
                    ID <?= $trs['id']; ?> - <?= $trs['keterangan']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Jumlah Barang</label>
        <input type="number" name="qty" min="1" required>

        <div class="btn-center">
            <button type="submit" name="simpan">Simpan</button>
        </div>
    </form>
</body>
</html>
