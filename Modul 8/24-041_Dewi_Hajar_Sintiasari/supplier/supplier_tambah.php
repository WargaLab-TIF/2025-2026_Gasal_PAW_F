<?php
include '../session/cek_owner.php';
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");

    header("Location: supplier_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>

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
        margin-top: 0;
    }

    label {
        font-weight: bold;
    }

    input, textarea, select {
        width: 300px;
        padding: 10px;
        border: 1px solid grey;
        border-radius: 5px;
        margin-top: 5px;
    }

    textarea {
        height: 70px;
        resize: none;
    }

    .btn {
        padding: 10px 16px;
        background: #0274bd;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        border: none;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn:hover {
        background: #0264a5;
    }
</style>

</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">

    <h2>Tambah Supplier</h2>

    <form method="POST">

        <label>Nama Supplier</label><br>
        <input type="text" name="nama" required><br><br>

        <label>No Telepon</label><br>
        <input type="text" name="telp"><br><br>

        <label>Alamat</label><br>
        <textarea name="alamat"></textarea><br><br>

        <button type="submit" class="btn">Simpan</button>

    </form>

</div>

</body>
</html>