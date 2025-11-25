<?php
include '../session/cek_owner.php';
include '../koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
$d = mysqli_fetch_assoc($q);

if (!$d) {
    echo "<script>alert('Data barang tidak ditemukan!'); window.location='barang_index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $supplier = mysqli_real_escape_string($koneksi, $_POST['supplier_id']);

    mysqli_query($koneksi,
        "UPDATE barang SET 
            kode_barang='$kode',
            nama_barang='$nama',
            harga='$harga',
            stok='$stok',
            supplier_id='$supplier'
        WHERE id='$id'"
    );

    header("Location: barang_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f5f5f5;
            font-family: Arial;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0274bd;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #0274bd;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #015a99;
        }
    </style>
</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">
    <h2>Edit Barang</h2>

    <form method="POST">

        Kode Barang:<br>
        <input type="text" name="kode_barang" value="<?= htmlspecialchars($d['kode_barang']) ?>" required><br>

        Nama Barang:<br>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($d['nama_barang']) ?>" required><br>

        Harga:<br>
        <input type="number" name="harga" value="<?= htmlspecialchars($d['harga']) ?>" required><br>

        Stok:<br>
        <input type="number" name="stok" value="<?= htmlspecialchars($d['stok']) ?>" required><br>

        Supplier:<br>
        <select name="supplier_id" required>
            <?php
            $sup = mysqli_query($koneksi, "SELECT id, nama FROM supplier ORDER BY nama");
            while($s = mysqli_fetch_assoc($sup)):
            ?>
                <option value="<?= $s['id'] ?>" 
                    <?= ($s['id'] == $d['supplier_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['nama']) ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit">Update</button>

    </form>
</div>

</body>
</html>