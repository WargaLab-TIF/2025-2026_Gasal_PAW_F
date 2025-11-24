<?php 
include "../cek_login.php";
include "../koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body style="font-family:Arial; padding:20px; background:#f3f3f3;">

<h2>Tambah User</h2>

<form action="proses_tambah_user.php" method="POST"
      style="width:400px; background:white; padding:20px; border-radius:10px;">

    Username:<br>
    <input type="text" name="username" required style="width:100%; padding:8px;"><br><br>

    Password:<br>
    <input type="password" name="password" required style="width:100%; padding:8px;"><br><br>

    Nama:<br>
    <input type="text" name="nama" required style="width:100%; padding:8px;"><br><br>

    Alamat:<br>
    <input type="text" name="alamat" required style="width:100%; padding:8px;"><br><br>

    HP:<br>
    <input type="text" name="hp" required style="width:100%; padding:8px;"><br><br>

    Level:<br>
    <select name="level" required style="width:100%; padding:8px;">
        <option value="">Pilih Level</option>
        <option value="1">Owner</option>
        <option value="2">Kasir</option>
    </select><br><br>

    <button type="submit" style="padding:10px 20px; background:green; color:white;">Simpan</button>
    <a href="user.php" 
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
