<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama = $_POST["nama"] ?? "";
    $telp = $_POST["telp"] ?? "";
    $jenis_kelamin = $_POST["jenis_kelamin"] ?? "";
    $alamat = $_POST["alamat"] ?? "";

    $query = "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat)
              VALUES ('$nama', '$jenis_kelamin', '$telp', '$alamat')";

    mysqli_query($conn, $query);

    header("Location: ../../data-master/data_pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan</title>
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
    <h2>Tambah Pelanggan</h2>

    <form action="" method="POST">

        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>No Telepon</label>
        <input type="text" name="telp" required>

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="L">Laki Laki</option>
            <option value="P">Perempuan</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat"></textarea>

        <button class="btn-submit" type="submit">Simpan</button>
    </form>

    <a class="btn-back" href="../../data-master/data_pelanggan.php">Kembali</a>
</div>
</body>
</html>