<?php
include 'koneksi.php';

$waktuTransaksiError = $keteranganError = "";
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelanggan_id = $_POST['pelanggan'];

    $valid = true;

    if (strtotime($waktu_transaksi) < strtotime(date("Y-m-d"))) {
        $waktuTransaksiError =  "Tanggal transaksi tidak boleh sebelum hari ini.";
        $valid = false;
    } 
    
    if (strlen($keterangan) < 3) {
        $keteranganError = "Keterangan minimal 3 karakter.";
        $valid = false;
    } 
    
    if ($valid) {
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, id_pelanggan) 
                  VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                alert('Transaksi berhasil ditambahkan.');
                document.location.href = 'transaksi.php';
            </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 30rem;">
            <h2 class="text-center mb-4">Tambah Data Transaksi</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="waktu_transaksi" class="form-label">Waktu Transaksi</label>
                    <input type="date" name="waktu_transaksi" class="form-control" required>
                    <p class="text-danger small"><?= $waktuTransaksiError ?></p>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan transaksi" required></textarea>
                    <p class="text-danger small"><?= $keteranganError ?></p>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" name="total" id="total" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pelanggan" class="form-label">Pelanggan</label>
                    <select name="pelanggan" class="form-select">
                        <?php while($row = mysqli_fetch_assoc($pelanggan)) { ?>
                            <option value="<?= $row['id_pelanggan'] ?>"><?= $row['nama_pelanggan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah Transaksi</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
