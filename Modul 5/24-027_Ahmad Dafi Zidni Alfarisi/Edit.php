<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM modul5 WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan!");
}

$nama = $data['nama'];
$telp = $data['telp'];
$alamat = $data['alamat'];
$errNama = $errTelp = $errAlamat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $telp = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errNama = "Nama hanya boleh huruf.";
    }
    if (empty($telp) || !preg_match("/^[0-9]+$/", $telp)) {
        $errTelp = "Telepon hanya boleh angka.";
    }
    if (empty($alamat) || !preg_match("/^(?=.*[a-zA-Z])(?=.*\d).+$/", $alamat)) {
        $errAlamat = "Alamat harus berisi huruf dan angka.";
    }

    if (!$errNama && !$errTelp && !$errAlamat) {
        mysqli_query($conn, "UPDATE modul5 SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
        echo "<script>alert('Data berhasil diperbarui'); window.location='index.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
</head>
<body>
<h2>Edit Data Supplier</h2>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
    <font color="red"><?php echo $errNama; ?></font><br>

    Telepon:<br>
    <input type="text" name="telp" value="<?php echo $telp; ?>"><br>
    <font color="red"><?php echo $errTelp; ?></font><br>

    Alamat:<br>
    <input type="text" name="alamat" value="<?php echo $alamat; ?>"><br>
    <font color="red"><?php echo $errAlamat; ?></font><br><br>

    <input type="submit" value="Update">
    <a href="index.php">Batal</a>
</form>

</body>
</html>
