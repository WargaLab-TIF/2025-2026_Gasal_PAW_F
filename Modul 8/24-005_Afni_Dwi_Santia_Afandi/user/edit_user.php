<?php 
include "../cek_login.php";
include "../koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
$data = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body style="font-family:Arial; padding:20px;">

<h2>Edit User</h2>

<form action="proses_edit_user.php" method="POST"
      style="width:400px; background:white; padding:20px; border-radius:10px;">

    <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

    Username:<br>
    <input type="text" name="username" required value="<?= $data['username'] ?>" style="width:100%; padding:8px;"><br><br>

    Password:<br>
    <input type="text" name="password" required value="<?= $data['password'] ?>" style="width:100%; padding:8px;"><br><br>

    Nama:<br>
    <input type="text" name="nama" required value="<?= $data['nama'] ?>" style="width:100%; padding:8px;"><br><br>

    Alamat:<br>
    <input type="text" name="alamat" required value="<?= $data['alamat'] ?>" style="width:100%; padding:8px;"><br><br>

    HP:<br>
    <input type="text" name="hp" required value="<?= $data['hp'] ?>" style="width:100%; padding:8px;"><br><br>

    Level:<br>
    <select name="level" required style="width:100%; padding:8px;">
        <option value="1" <?= ($data['level']==1)?'selected':'' ?>>Owner</option>
        <option value="2" <?= ($data['level']==2)?'selected':'' ?>>Kasir</option>
    </select><br><br>

    <button type="submit" style="padding:10px 20px; background:#1a73e8; color:white;">Update</button>
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
