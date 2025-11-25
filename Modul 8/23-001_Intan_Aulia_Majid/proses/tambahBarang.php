<?php

include "../koneksi.php";

$sql = "SELECT * FROM supplier";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST"){ 
    $kodeBarang = $_POST['kode_barang'];
    $namaBarang = $_POST['nama_barang'];
    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];
    $supplier   = $_POST['supplier_id'];

    $stmt = $koneksi->prepare("
        INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) 
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssiii", $kodeBarang, $namaBarang, $harga, $stok, $supplier);
    $stmt->execute();
    $stmt->close();

    header("location: ../barang.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>
    <h3>Tambah Barang</h3>

    <form action="" method="POST">
        <label>Kode Barang</label><br>
        <input type="text" name="kode_barang"><br><br>

        <label>Nama Barang</label><br>
        <input type="text" name="nama_barang"><br><br>

        <label>Harga</label><br>
        <input type="text" name="harga"><br><br>

        <label>Stok</label><br>
        <input type="text" name="stok"><br><br>

        <select name="supplier_id">
            <option value="">-- Pilih Supplier --</option>
            <?php foreach($data as $row): ?>
                <option value="<?= $row['id']; ?>">
                    <?= $row['nama']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
