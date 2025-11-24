<?php 
include "../cek_login.php";
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
</head>

<body style="font-family:Arial; background:#f3f3f3; padding:20px;">

<h2>Edit Pelanggan</h2>

<form action="proses_edit_pelanggan.php" method="POST"
      style="width:400px; padding:20px; background:white; border-radius:10px;">

    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    Nama:<br>
    <input type="text" name="nama" required
           value="<?= $data['nama'] ?>"
           style="width:100%; padding:8px;"><br><br>

    Alamat:<br>
    <textarea name="alamat" required
              style="width:100%; padding:8px;"><?= $data['alamat'] ?></textarea><br><br>

    No HP:<br>
    <input type="text" name="telp" required
           value="<?= $data['telp'] ?>"
           style="width:100%; padding:8px;"><br><br>

    <button type="submit"
            style="background:#1a73e8; padding:10px 20px; color:white; cursor:pointer;">
        Update
    </button>
    <a href="pelanggan.php" 
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
