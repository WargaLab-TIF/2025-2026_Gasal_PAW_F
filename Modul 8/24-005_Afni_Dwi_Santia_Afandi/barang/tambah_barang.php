<?php 
include "../cek_login.php";
include "../koneksi.php";

$supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
</head>

<body style="font-family:Arial; padding:20px; background:#f3f3f3;">

<h2>Tambah Data Barang</h2>

<form action="proses_tambah_barang.php" method="POST"
      style="width:400px; background:white; padding:20px; border-radius:10px;">

    Kode Barang:<br>
    <input type="text" name="kode_barang" required
           style="width:100%; padding:8px;"><br><br>

    Nama Barang:<br>
    <input type="text" name="nama_barang" required
           style="width:100%; padding:8px;"><br><br>

    Harga:<br>
    <input type="number" name="harga" required
           style="width:100%; padding:8px;"><br><br>

    Stok:<br>
    <input type="number" name="stok" required
           style="width:100%; padding:8px;"><br><br>

    Supplier:<br>
    <select name="supplier_id" required style="width:100%; padding:8px;">
        <option value="">Pilih Supplier</option>
        <?php while ($row = mysqli_fetch_assoc($supplier)) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
        <?php } ?>
    </select><br><br>

    <button type="submit"
            style="padding:10px 20px; background:green; color:white; cursor:pointer;">
        Simpan
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
