<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
</head>

<body style="font-family:Arial; background:#f3f3f3; padding:20px;">

<h2>Tambah Supplier</h2>

<form action="proses_tambah_supplier.php" method="POST"
      style="width:400px; padding:20px; background:white; border-radius:10px;">

    Nama Supplier:<br>
    <input type="text" name="nama" required
           style="width:100%; padding:8px;"><br><br>

    Alamat:<br>
    <textarea name="alamat" required
              style="width:100%; padding:8px;"></textarea><br><br>

    No HP:<br>
    <input type="text" name="no_hp" required
           style="width:100%; padding:8px;"><br><br>

    <button type="submit"
            style="background:green; padding:10px 20px; color:white; cursor:pointer;">
        Simpan
    </button>
    <a href="supplier.php" 
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
