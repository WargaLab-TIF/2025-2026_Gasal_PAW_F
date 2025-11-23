<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $query = "UPDATE user SET 
                    username='$username',
                    password='$password',
                    nama='$nama',
                    alamat='$alamat',
                    hp='$hp',
                    level='$level'
                  WHERE id_user=$id";
    } else {
        $query = "UPDATE user SET 
                    username='$username',
                    nama='$nama',
                    alamat='$alamat',
                    hp='$hp',
                    level='$level'
                  WHERE id_user=$id";
    }

    mysqli_query($conn, $query);

    header("Location: ../../data-master/data_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body {
            font-family: verdana;
            background: #f1f3f6;
            padding: 20px;
        }

        .container {
            width: 400px;
            background: white;
            margin: auto;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 12px;
        }

        textarea {
            height: 70px;
            resize: none;
        }

        .btn-submit {
            width: 100%;
            background: #ffc107;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #e0a800;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" value="<?= $data['username']; ?>" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Kosongkan Jika tidak Mengganti">

        <label>Nama User</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

        <label>Alamat</label>
        <textarea name="alamat"><?= $data['alamat']; ?></textarea>

        <label>No HP</label>
        <input type="text" name="hp" value="<?= $data['hp']; ?>">

        <label>Level</label>
        <select name="level">
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
        </select>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>

    <a href="../../data-master/data_user.php" class="btn-back">Kembali</a>
</div>
</body>
</html>