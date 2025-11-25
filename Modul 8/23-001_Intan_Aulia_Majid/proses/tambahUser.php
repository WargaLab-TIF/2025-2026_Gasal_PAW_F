<?php
include "../koneksi.php";

// Jika form disubmit
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user (username, nama, alamat, hp, level, password) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $sql);

    mysqli_stmt_bind_param($stmt, "ssssss", 
        $username, 
        $nama, 
        $alamat, 
        $hp, 
        $level, 
        $password
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>

<h3>Tambah User</h3>

<form action="" method="POST">

    <label>Username</label><br>
    <input type="text" name="username" required
        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : '' ?>"
    ><br><br>

    <label>Password</label><br>
    <input type="text" name="password" required
        value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8') : '' ?>"
    ><br><br>

    <label>Nama</label><br>
    <input type="text" name="nama" required
        value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8') : '' ?>"
    ><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8') : '' ?></textarea><br><br>

    <label>No HP</label><br>
    <input type="text" name="hp" required
        value="<?= isset($_POST['hp']) ? htmlspecialchars($_POST['hp'], ENT_QUOTES, 'UTF-8') : '' ?>"
    ><br><br>

    <label>Level</label><br>
    <select name="level" required>
        <option value="">-- Pilih Level --</option>
        <option value="1" <?= (isset($_POST['level']) && $_POST['level']=='1') ? 'selected' : '' ?>>Admin</option>
        <option value="2" <?= (isset($_POST['level']) && $_POST['level']=='2') ? 'selected' : '' ?>>Kasir</option>
        <option value="3" <?= (isset($_POST['level']) && $_POST['level']=='3') ? 'selected' : '' ?>>Owner</option>
    </select><br><br>

    <button type="submit">Simpan</button>
    <a href="../user.php">Kembali</a>

</form>


</body>
</html>
