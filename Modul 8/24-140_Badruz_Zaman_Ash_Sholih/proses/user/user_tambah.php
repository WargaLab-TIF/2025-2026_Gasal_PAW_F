<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $level    = $_POST['level'];

    $query = "INSERT INTO user (username, password, nama, alamat, hp, level)
              VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')";

    mysqli_query($conn, $query);

    header("Location: ../../data-master/data_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
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
            margin-bottom: 20px;
            color: #333;
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
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #0056b3;
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
    <h2>Tambah User</h2>

    <form action="" method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Nama User</label>
        <input type="text" name="nama" required>

        <label>Alamat</label>
        <textarea name="alamat"></textarea>

        <label>No HP</label>
        <input type="text" name="hp">

        <label>Jenis User</label>
        <select name="level">
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
        </select>

        <button class="btn-submit" type="submit">Simpan</button>
    </form>

    <a class="btn-back" href="../../data-master/data_user.php">Kembali</a>
</div>
</body>
</html>