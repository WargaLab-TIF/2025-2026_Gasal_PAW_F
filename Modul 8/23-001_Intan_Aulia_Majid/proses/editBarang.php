<?php

include "koneksi.php";

$idBarang = $_GET['id'];

$stmt = $koneksi->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->bind_param("i", $idBarang);
$stmt->execute();
$barang = $stmt->get_result()->fetch_assoc();
$stmt->close();

$sql = "SELECT * FROM supplier";
$query = mysqli_query($koneksi, $sql);
$dataSupplier = mysqli_fetch_all($query, MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $kodeBarang = $_POST['kode_barang'];
    $namaBarang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier = $_POST['supplier_id'];

    $stmt = $koneksi->prepare("UPDATE barang SET 
                    kode_barang = ?,
                    nama_barang = ?,
                    harga = ?,
                    stok = ?,
                    supplier_id = ?
                  WHERE id = ?");
    $stmt->bind_param('ssiisi', $kodeBarang, $namaBarang, $harga, $stok, $supplier, $idBarang);

    $update = $stmt->execute();
    $stmt->close();

    if($update){
        header("location: ../barang.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>
    <h3>Edit Barang</h3>

    <form action="" method="POST">
        <label>Kode Barang</label><br>
        <input type="text" name="kode_barang" 
            value="<?= htmlspecialchars($barang['kode_barang'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

        <label>Nama Barang</label><br>
        <input type="text" name="nama_barang" 
            value="<?= htmlspecialchars($barang['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

        <label>Harga</label><br>
        <input type="text" name="harga" 
            value="<?= htmlspecialchars($barang['harga'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

        <label>Stok</label><br>
        <input type="text" name="stok" 
            value="<?= htmlspecialchars($barang['stok'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

        <label>Supplier</label><br>
        <select name="supplier_id">
            <option value="">-- Pilih Supplier --</option>
            <?php foreach($dataSupplier as $row): ?>
                <option value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>"
                    <?= ($row['id'] == $barang['supplier_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Update</button>
    </form>

</body>
</html>