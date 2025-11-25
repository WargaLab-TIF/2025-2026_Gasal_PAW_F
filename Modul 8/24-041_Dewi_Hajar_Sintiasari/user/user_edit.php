<?php
include '../session/cek_owner.php';
include '../koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<script>alert('Data user tidak ditemukan!'); window.location='user_index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_input = $_POST['password'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    if (!empty($password_input)) {
        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $data['password'];
    }

    $sql = "UPDATE user SET 
        username='$username',
        password='$hashed_password',
        nama='$nama',
        alamat='$alamat',
        hp='$hp',
        level='$level'
        WHERE id_user='$id'";
        
    mysqli_query($koneksi, $sql);

    header("Location: user_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
        margin-top: 0;
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
    }

    input[type="text"], input[type="number"], select, textarea {
        width: 100%; 
        padding: 10px;
        margin: 5px 0 15px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        height: 80px;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        background: #0274bd;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
    }

    .btn:hover {
        background: #015a99;
    }
</style>

</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">

    <h2>Edit User</h2>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>

        <label>Password</label>
        <input type="text" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
        
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label>Alamat</label>
        <textarea name="alamat"><?= htmlspecialchars($data['alamat']) ?></textarea>

        <label>No HP</label>
        <input type="text" name="hp" value="<?= htmlspecialchars($data['hp']) ?>">

        <label>Level</label>
        <select name="level" required>
            <option value="1" <?= $data['level']==1?'selected':'' ?>>Owner</option>
            <option value="2" <?= $data['level']==2?'selected':'' ?>>Kasir</option>
        </select>

        <button type="submit" class="btn">Update</button>

    </form>

</div>

</body>
</html>