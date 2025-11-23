<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE pelanggan SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telp = '$telp', alamat = '$alamat' WHERE id = $id";

    mysqli_query($conn, $query);

    header("Location: ../../data-master/data_pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
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
    <h2>Edit Pelanggan</h2>

    <form method="POST">

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

        <label>No Telepon</label>
        <input type="text" name="telp" value="<?= $data['telp']; ?>" required>

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="L" <?= $data['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki Laki</option>
            <option value="P" <?= $data['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat"><?= $data['alamat']; ?></textarea>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>

    <a href="../../data-master/data_pelanggan.php" class="btn-back">Kembali</a>
</div>
</body>
</html>