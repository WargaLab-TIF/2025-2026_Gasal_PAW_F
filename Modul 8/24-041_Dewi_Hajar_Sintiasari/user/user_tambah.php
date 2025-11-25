<?php
include '../session/cek_owner.php';
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];

    mysqli_query($koneksi, "INSERT INTO user (username, password, nama, alamat, hp, level)
                            VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')");

    header("Location: user_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>

<style>
    body {
        background: #f5f5f5;
        font-family: Arial;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    h2 {
        background: #0274bd;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin: 0 0 15px 0;
    }

    label {
        font-weight: bold;
    }

    input, select, textarea {
        padding: 8px;
        width: 300px;
        border: 1px solid #999;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    textarea {
        height: 80px;
        width: 300px;
    }

    .btn {
        display: inline-block;
        padding: 10px 16px;
        background: #0274bd;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
    }

    .btn:hover {
        background: #0264a5;
    }
</style>

</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">

    <h2>Tambah User</h2>

    <form method="POST">

        <label>Username</label><br>
        <input type="text" name="username" required><br>

        <label>Password</label><br>
        <input type="text" name="password" required><br>

        <label>Nama</label><br>
        <input type="text" name="nama" required><br>

        <label>Alamat</label><br>
        <textarea name="alamat"></textarea><br>

        <label>No HP</label><br>
        <input type="text" name="hp"><br>

        <label>Level</label><br>
        <select name="level" required>
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
        </select><br>

        <button type="submit" class="btn">Simpan</button>

    </form>

</div>

</body>
</html>