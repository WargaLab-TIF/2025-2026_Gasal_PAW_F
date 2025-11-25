<?php
include "../koneksi.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $nama, $telp, $alamat);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../supplier.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
</head>
<body>

<h3>Tambah Supplier</h3>

<form action="" method="POST">
    <label>Nama</label><br>
    <input 
        type="text" 
        name="nama" 
        required
        value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8') : '' ?>"
    ><br><br>

    <label>Telepon</label><br>
    <input 
        type="text" 
        name="telp" 
        required
        value="<?= isset($_POST['telp']) ? htmlspecialchars($_POST['telp'], ENT_QUOTES, 'UTF-8') : '' ?>"
    ><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat'], ENT_QUOTES, 'UTF-8') : '' ?></textarea><br><br>

    <button type="submit">Simpan</button>
    <a href="supplier.php">Kembali</a>
</form>

</body>
</html>
