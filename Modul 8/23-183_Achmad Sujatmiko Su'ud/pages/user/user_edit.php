<?php
// pages/user/user_edit.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

// PENCEGAHAN SQL INJECTION: Type Casting
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];
    
    // PENCEGAHAN SQL INJECTION
    $username = mysqli_real_escape_string($conn, $username);
    $nama     = mysqli_real_escape_string($conn, $nama);
    $alamat   = mysqli_real_escape_string($conn, $alamat);
    $hp       = mysqli_real_escape_string($conn, $hp);
    
    if ($_POST['password'] != "") {
        $pass = md5($_POST['password']);
        mysqli_query($conn, "UPDATE user 
                             SET username='$username', nama='$nama', password='$pass', 
                             alamat='$alamat', hp='$hp', level='$level' 
                             WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE user 
                             SET username='$username', nama='$nama', 
                             alamat='$alamat', hp='$hp', level='$level'
                             WHERE id=$id");
    }

    header("Location: user_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include "../../includes/navigasi.php"; ?>
    <div class="container" style="width: 450px;">
        <h2 style="text-align:left; color: #007bff; margin-bottom: 25px;">Edit User: <?= htmlspecialchars($data['username']) ?></h2>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>
            <label>Nama User</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            <label>Alamat</label>
            <textarea name="alamat" rows="4"><?= htmlspecialchars($data['alamat']) ?></textarea>
            <label>Nomor HP</label>
            <input type="text" name="hp" value="<?= htmlspecialchars($data['hp']) ?>">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password">
            <label>Jenis User</label>
            <select name="level" required>
                <option value="2" <?= ((int)$data['level'] === 2) ? 'selected' : '' ?>>User Biasa</option>
                <option value="1" <?= ((int)$data['level'] === 1) ? 'selected' : '' ?>>Admin</option>
            </select>
            
            <div style="margin-top: 20px;">
                <button class="btn btn-blue" type="submit">Update</button>
                <a class="btn btn-grey" href="user_list.php">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>