<?php 
include "../cek_login.php";
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'"));
$supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
</head>

<body style="font-family:Arial; padding:20px; background:#f3f3f3;">

<h2>Edit Barang</h2>

<form action="proses_edit_barang.php" method="POST"
      style="width:400px; background:white; padding:20px; border-radius:10px;">

    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    Kode Barang:<br>
    <input type="text" name="kode_barang" required
           value="<?= $data['kode_barang'] ?>" style="width:100%; padding:8px;"><br><br>

    Nama Barang:<br>
    <input type="text" name="nama_barang" required
           value="<?= $data['nama_barang'] ?>" style="width:100%; padding:8px;"><br><br>

    Harga:<br>
    <input type="number" name="harga" required
           value="<?= $data['harga'] ?>" style="width:100%; padding:8px;"><br><br>

    Stok:<br>
    <input type="number" name="stok" required
           value="<?= $data['stok'] ?>" style="width:100%; padding:8px;"><br><br>

    Supplier:<br>
    <select name="supplier_id" required style="width:100%; padding:8px;">
        <?php while ($s = mysqli_fetch_assoc($supplier)) { ?>
            <option value="<?= $s['id'] ?>"
                <?= ($s['id']==$data['supplier_id'])?'selected':'' ?>>
                <?= $s['nama'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit"
            style="padding:10px 20px; background:#1a73e8; color:white;">
        Update
    </button>
    <a href="barang.php" 
        style="
                background:red; 
                color:white; 
                padding:10px 20px; 
                border:none; 
                border-radius:3px; 
                text-decoration:none;
        ">
    Batal
    </a>

</form>

</body>
</html>
