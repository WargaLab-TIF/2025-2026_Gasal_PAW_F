<?php
    session_start();
    if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
    require "../conn.php";
    $id = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM barang WHERE id = '$id'");
    $row = mysqli_fetch_assoc($data);
    $suppliers = mysqli_query($conn, "SELECT * FROM supplier");
    if (isset($_POST['update'])) {
        $nama = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $supplier_id = $_POST['supplier_id'];
        $query = "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok', supplier_id='$supplier_id' WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data diupdate!');window.location='datamaster.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Barang</title>
        <style>
            body {
                font-family:sans-serif;
                background:#f4f4f4;
                padding:20px;
            }
            .container {
                background:white;
                max-width:500px;
                margin:auto;
                padding:20px;
                border-radius:5px;
                box-shadow:0 0 10px rgba(0,0,0,0.1);
            }
            input, select  {
                width:100%;
                padding:10px;
                margin:10px 0;
                border:1px solid #ddd;
                border-radius:4px;
                box-sizing:border-box;
            }
            button  {
                width:100%;
                padding:10px;
                background:#f39c12;
                color:white;
                border:none;
                border-radius:4px;
                cursor:pointer;
            }
            button:hover  {
                background:#d35400;
            }
            .back-btn  {
                background:#555;
                margin-top:10px;
                display:block;
                text-align:center;
                text-decoration:none;
                padding:10px;
                border-radius:4px;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Edit Barang</h2>
            <form method="POST">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= $row['nama_barang'] ?>" required>
                <label>Harga</label>
                <input type="number" name="harga" value="<?= $row['harga'] ?>" required>
                <label>Stok</label>
                <input type="number" name="stok" value="<?= $row['stok'] ?>" required>
                <label>Supplier</label>
                <select name="supplier_id" required>
                    <?php while($s = mysqli_fetch_assoc($suppliers)): ?>
                    <option value="<?= $s['id'] ?>" <?= ($s['id'] == $row['supplier_id']) ? 'selected' : '' ?>><?= $s['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="update">Update</button>
                <a href="datamaster.php" class="back-btn">Kembali</a>
            </form>
        </div>
    </body>
</html>