<?php

include "../../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_barang = $_POST["kode_barang"];
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $supplier_id = $_POST["supplier_id"];

    $sql = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok', '$supplier_id')";
    if (mysqli_query($conn, $sql)) {
        header("location: barang.php");
    }
}

$query_supplier = "SELECT id, nama FROM supplier";
$result_supplier = mysqli_query($conn, $query_supplier);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inputStyle.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <label for="kode_barang">Kode barang: </label><br>
            <input type="text" name="kode_barang" id="kode_barang"><br><br>

            <label for="nama_barang">Nama Barang: </label><br>
            <input type="text" name="nama_barang" id="nama_barang"><br><br>

            <label for="harga">Harga: </label><br>
            <input type="number" name="harga" id="harga"><br><br>

            <label for="stok">Stok: </label><br>
            <input type="number" name="stok" id="stok"><br><br>

            <label for="supplier_id">Supplier: </label><br>
            <select name="supplier_id" id="supplier_id" required>
                <option value="">-- Pilih Supplier --</option>
                <?php
                if (mysqli_num_rows($result_supplier) > 0) {
                    while ($row = mysqli_fetch_assoc($result_supplier)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                    }
                }
                ?>
            </select><br><br>

            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='barang.php'">Batal</button>
        </form>
    </div>
</body>

</html>