<?php
include "koneksi.php";

if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $insertQuery = "INSERT INTO supplier (nama, telp, alamat) 
                    VALUES ('$nama', '$telp', '$alamat')";
    if (mysqli_query($conn, $insertQuery)) {
        header("Location: supplier.php"); 
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
            <h2 class="text-center mb-4">Tambah Supplier</h2>
            <div class="form-group">
                <label for="nama">Nama Supplier</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telp">No. Telp</label>
                <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-success btn-block">Tambah Supplier</button>
            <a href="supplier.php" class="btn btn-warning btn-block">Back</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
