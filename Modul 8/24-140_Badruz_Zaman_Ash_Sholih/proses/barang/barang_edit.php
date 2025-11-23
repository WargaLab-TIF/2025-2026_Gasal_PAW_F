<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$data = mysqli_fetch_assoc($result);

$supplier = mysqli_query($conn, "SELECT * FROM supplier");

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $supplier_id = $_POST["supplier_id"];

    $query = "UPDATE barang SET 
            nama_barang = '$nama_barang',
            harga = '$harga',
            stok = '$stok',
            supplier_id = '$supplier_id'
            WHERE id = $id";

    mysqli_query($conn, $query);

    header("Location: ../../data-master/data_barang.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <style>
        body {
            font-family: verdana;
            background: #f1f3f6;
            padding: 20px;
        }

        .container {
            width: 400px;
            background: white;
            margin: auto;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 12px;
        }

        textarea {
            height: 70px;
            resize: none;
        }

        .btn-submit {
            width: 100%;
            background: #ffc107;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #e0a800;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Barang</h2>

    <form method="POST">

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" required><br>

        <label>Harga</label>
        <input type="text" name="harga" value="<?= $data['harga']; ?>" required>

        <label>Stok</label>
        <input type="text" name="stok" value="<?= $data['stok']; ?>" required><br>

        <label>Nama Supplier</label>
        <select name="supplier_id" required>
            <?php while($row = mysqli_fetch_assoc($supplier)) { ?>
                <option value="<?= $row['id']; ?>"
                    <?= $row['id'] == $data['supplier_id'] ? "selected" : ""; ?>>
                    <?= $row['nama']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>

    <a href="../../data-master/data_barang.php" class="btn-back">Kembali</a>
</div>
</body>
</html>