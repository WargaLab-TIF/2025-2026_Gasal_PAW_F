<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM supplier WHERE id = $id";
    $query = mysqli_query($koneksi, $sql);
    $result = mysqli_fetch_assoc($query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = $_POST["id"];
    $nama   = $_POST["nama"];
    $telp   = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: data_supplier.php");
        exit;
    } else {
        echo "Gagal mengedit data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
</head>
<body>
    <h2>Edit Data Supplier</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $result['id']; ?>">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $result['nama']; ?>"><br>
        <label>Telepon:</label><br>
        <input type="text" name="telp" value="<?= $result['telp']; ?>"><br>
        <label>Alamat:</label><br>
        <textarea name="alamat" rows="3" cols="30"><?= $result['alamat']; ?></textarea><br><br>
        <input type="submit" value="Update">
         <input type="button" value="Batal" onclick="window.location.href='data_supplier.php'">
    </form>
</body>
</html>
