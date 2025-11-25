<?php
include '../session/cek_session.php';
include '../template/navbar.php';
include '../koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id=$id");
$data  = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<script>alert('Data pelanggan tidak ditemukan!'); window.location='pelanggan_index.php';</script>";
    exit;
}

if(isset($_POST['update'])){
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);

    mysqli_query($koneksi, 
        "UPDATE pelanggan SET nama='$nama', alamat='$alamat', telp='$telp' WHERE id=$id"
    );

    header("Location: pelanggan_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
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
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #0274bd;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #015a99;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Pelanggan</h2>

    <form method="POST">
        Nama:<br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br>

        Alamat:<br>
        <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required><br>

        No Telepon:<br> <input type="text" name="telp" value="<?= htmlspecialchars($data['telp']) ?>" required><br> <button type="submit" name="update">Update</button>
    </form>
</div>

</body>
</html>