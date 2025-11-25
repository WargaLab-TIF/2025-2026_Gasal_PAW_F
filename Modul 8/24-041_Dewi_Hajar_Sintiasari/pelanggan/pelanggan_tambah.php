<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

if(isset($_POST['simpan'])){
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp     = $_POST['hp'];

    mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, alamat, hp) VALUES ('$nama', '$alamat', '$hp')");

    header("Location: pelanggan_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan</title>

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

    input {
        padding: 8px;
        width: 300px;
        border: 1px solid #999;
        border-radius: 5px;
        margin-bottom: 15px;
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

<div class="container">

    <h2>Tambah Pelanggan</h2>

    <form method="POST">

        <label>Nama</label><br>
        <input type="text" name="nama" required><br>

        <label>Alamat</label><br>
        <input type="text" name="alamat" required><br>

        <label>No Telp</label><br>
        <input type="text" name="hp" required><br>

        <button type="submit" name="simpan" class="btn">Simpan</button>

    </form>

</div>

</body>
</html>