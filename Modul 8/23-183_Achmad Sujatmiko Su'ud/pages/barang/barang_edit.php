<?php
// pages/barang/barang_edit.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

// PENCEGAHAN SQL INJECTION: Type Casting
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id_barang=$id"));
$suppliers = mysqli_query($conn, "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $beli = $_POST['harga_beli'];
    $jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['id_supplier'];

    // PENCEGAHAN SQL INJECTION: mysqli_real_escape_string()
    $kode = mysqli_real_escape_string($conn, $kode);
    $nama = mysqli_real_escape_string($conn, $nama);

    mysqli_query($conn, "UPDATE barang 
                         SET kode_barang='$kode', nama_barang='$nama', harga_beli='$beli', 
                         harga_jual='$jual', stok='$stok', id_supplier='$supplier_id'
                         WHERE id_barang=$id");
    
    header("Location: barang_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <div class="container" style="width: 450px;">
        <h2 style="text-align:left; color: #007bff; margin-bottom: 25px;">Edit Barang: <?= htmlspecialchars($data['nama_barang']) ?></h2>

        <form method="POST">

            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?= htmlspecialchars($data['kode_barang']) ?>" required>

            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']) ?>" required>
            
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" value="<?= htmlspecialchars($data['harga_beli']) ?>" required min="0">

            <label>Harga Jual</label>
            <input type="number" name="harga_jual" value="<?= htmlspecialchars($data['harga_jual']) ?>" required min="0">

            <label>Stok</label>
            <input type="number" name="stok" value="<?= htmlspecialchars($data['stok']) ?>" required min="0">

            <label>Supplier</label>
            <select name="id_supplier">
                <option value="">-- Pilih Supplier --</option>
                <?php while ($s = mysqli_fetch_assoc($suppliers)) : ?>
                    <option value="<?= htmlspecialchars($s['id_supplier']) ?>" <?= ((int)$data['id_supplier'] === (int)$s['id_supplier']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s['nama_supplier']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <div style="margin-top: 20px;">
                <button class="btn btn-blue" type="submit">Update</button>
                <a class="btn btn-red" href="barang_list.php">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>