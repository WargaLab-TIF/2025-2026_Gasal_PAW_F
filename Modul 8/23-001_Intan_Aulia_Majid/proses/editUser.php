<?php
include "../koneksi.php";

$id = $_GET['id'];

$stmt = $koneksi->prepare("SELECT * FROM user WHERE id_user = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];
    $password = $_POST['password'];

    $stmt = $koneksi->prepare("
        UPDATE user SET 
            username = ?, 
            nama = ?, 
            alamat = ?, 
            hp = ?, 
            level = ?, 
            password = ?
        WHERE id_user = ?
    ");

    $stmt->bind_param(
        "ssssisi",
        $username,
        $nama,
        $alamat,
        $hp,
        $level,
        $password,
        $id
    );

    $stmt->execute();
    $stmt->close();

    header("Location: ../user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<h3>Edit User</h3>

<form action="editUser.php?id=<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>" method="POST">

    <label>Username</label><br>
    <input type="text" name="username" 
           value="<?= htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Password</label><br>
    <input type="text" name="password" 
           value="<?= htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Nama</label><br>
    <input type="text" name="nama" 
           value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= htmlspecialchars($data['alamat'], ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <label>No HP</label><br>
    <input type="text" name="hp" 
           value="<?= htmlspecialchars($data['hp'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Level</label><br>
    <select name="level" required>
        <option value="1" <?= ($data['level']==1?'selected':'') ?>>1</option>
        <option value="2" <?= ($data['level']==2?'selected':'') ?>>2</option>
        <option value="3" <?= ($data['level']==3?'selected':'') ?>>3</option>
    </select><br><br>

    <button type="submit">Update</button>
    <a href="../user.php">Kembali</a>

</form>


</body>
</html>
