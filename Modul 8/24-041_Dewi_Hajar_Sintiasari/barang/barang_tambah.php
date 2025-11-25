<?php
include '../session/cek_owner.php';
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier = $_POST['supplier_id'];

    mysqli_query($koneksi, "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES ('$kode', '$nama', '$harga','$stok', '$supplier')");

    header("Location: barang_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>

<style>
    body {
        background: #f5f5f5;
        font-family: Arial;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    h2 {
        background: #0274bd;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin: 0 0 15px 0;
    }

    label {
        font-weight: bold;
    }

    input, select {
        padding: 8px;
        width: 300px;
        border: 1px solid #999;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .btn {
        display: inline-block;
        padding: 10px 16px;
        background: #0274bd;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
    }

    .btn:hover {
        background: #0264a5;
    }
</style>
</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">

    <h2>Tambah Barang</h2>

    <form method="POST">

        <label>Kode Barang</label><br>
        <input type="text" name="kode_barang" required><br>

        <label>Nama Barang</label><br>
        <input type="text" name="nama_barang" required><br>

        <label>Harga</label><br>
        <input type="number" name="harga" required><br>

        <label>Stok</label><br>
        <input type="number" name="stok" required><br>

        <label>Supplier</label><br>
        <select name="supplier_id" required>
            <option value="">--Pilih Supplier--</option>
            <?php
            $sup = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($s = mysqli_fetch_assoc($sup)):
            ?>
                <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit" class="btn">Simpan</button>

    </form>

</div>

</body>
</html>