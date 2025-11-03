<?php
include "koneksi.php";

$nama = $telp = $alamat = "";
$errNama = $errTelp = $errAlamat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $telp = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errNama = "Nama hanya boleh huruf dan tidak boleh kosong.";
    }
    if (empty($telp) || !preg_match("/^[0-9]+$/", $telp)) {
        $errTelp = "Telepon hanya boleh angka dan tidak boleh kosong.";
    }
    if (empty($alamat) || !preg_match("/^(?=.*[a-zA-Z])(?=.*\d).+$/", $alamat)) {
        $errAlamat = "Alamat harus berisi huruf dan angka.";
    }

    if (!$errNama && !$errTelp && !$errAlamat) {
        $sql = "INSERT INTO modul5 (nama, telp, alamat) VALUES ('$nama','$telp','$alamat')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Data berhasil ditambahkan'); window.location='index.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>
<h2>Tambah Data</h2>

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

    <input type="submit" value="Simpan">
    <a href="index.php">Batal</a>
</form>

</body>
</html>
