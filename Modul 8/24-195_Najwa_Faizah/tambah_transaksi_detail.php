<?php
include 'koneksi.php';

$barangError = "";
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");

if (isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $barang = mysqli_query($conn, "SELECT * FROM barang WHERE id NOT IN (SELECT id_barang FROM transaksi_detail WHERE id_transaksi='$id_transaksi')");
} else {
    $barang = mysqli_query($conn, "SELECT * FROM barang");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi = $_POST['id_transaksi'];
    $barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    $cek_barang = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE id_transaksi='$id_transaksi' AND id_barang='$barang'");
    if (mysqli_num_rows($cek_barang) > 0) {
        $barangError = "Barang ini sudah ada dalam transaksi.";
    } else {
        $barangData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id_barang='$barang'"));
        $harga_total = $barangData['harga'] * $qty;
        
        $query = "INSERT INTO transaksi_detail (id_transaksi, id_barang, qty, harga) VALUES ('$id_transaksi', '$barang', '$qty', '$harga_total')";
        if (mysqli_query($conn, $query)) {
            updateTotalTransaksi($conn, $id_transaksi);
            echo "<script>
            alert('Detail transaksi berhasil ditambahkan.');
            document.location.href = 'transaksi.php';
            </script>";
        }
    }
}

function updateTotalTransaksi($conn, $id_transaksi) {
    $result = mysqli_query($conn, "SELECT SUM(harga * qty) AS total FROM transaksi_detail WHERE id_transaksi='$id_transaksi'");
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'] ?? 0;

    mysqli_query($conn, "UPDATE transaksi SET total = '$total' WHERE id='$id_transaksi'");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 30rem;">
            <h2 class="text-center mb-4">Tambah Detail Transaksi</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="id_barang" class="form-label">Pilih Barang</label>
                    <select name="id_barang" class="form-select">
                        <option value="" disabled selected>Pilih Barang</option>
                        <?php while($row = mysqli_fetch_assoc($barang)) { ?>
                            <option value="<?= $row['id_barang'] ?>"><?= $row['nama_barang'] ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger small"><?= $barangError ?></p>
                </div>
                <div class="mb-3">
                    <label for="id_transaksi" class="form-label">ID Transaksi</label>
                    <select name="id_transaksi" class="form-select">
                        <option value="" disabled selected>Pilih ID Transaksi</option>
                        <?php while($row = mysqli_fetch_assoc($transaksi)) { ?>
                            <option value="<?= $row['id_transaksi'] ?>"><?= $row['id_transaksi'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" name="qty" class="form-control" required placeholder="Masukkan Jumlah Barang">
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah Detail Transaksi</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
