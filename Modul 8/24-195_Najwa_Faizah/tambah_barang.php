<?php
include "koneksi.php";

if (isset($_POST['add'])) {
    $kode = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supp = $_POST['id_supplier'];

    $insertQuery = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, id_supplier) 
                    VALUES ('$kode', '$nama_barang', '$harga', '$stok', '$supp')";
    if (mysqli_query($conn, $insertQuery)) {
        header("Location: barang.php"); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <form method="POST" class="card p-4">
            <h2 class="text-center mb-4">Tambah Barang</h2>
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" name="harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" name="stok" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_supplier">Id Supplier</label>
                <input type="text" name="id_supplier" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-success btn-block">Tambah Barang</button>
            <a href="supplier.php" class="btn btn-warning btn-block">Back</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
