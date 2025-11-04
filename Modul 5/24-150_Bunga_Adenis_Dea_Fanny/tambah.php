<?php
include "koneksi.php";

$nama = "";
$telp = "";
$alamat = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Validasi nama: hanya huruf, spasi, titik
    if ($nama == "" || !preg_match("/^[A-Za-z. ]+$/", $nama)) {
        $errors[] = "Nama tidak boleh kosong dan hanya boleh huruf serta titik.";
    }
    // Validasi telp: angka saja
    if ($telp == "" || !preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Telp tidak boleh kosong dan hanya boleh angka.";
    }
    // Validasi alamat: tidak boleh kosong
    if ($alamat == "") {
        $errors[] = "Alamat tidak boleh kosong.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Supplier</title>
</head>
<body>
    <h2>Tambah Data Supplier</h2>

    <?php if (!empty($errors)): foreach ($errors as $e): ?>
        <p style="color:red;"><?php echo $e; ?></p>
    <?php endforeach; endif; ?>

    <form method="post" action="">
        <label>Nama</label><br>
        <input type="text" name="nama" value="<?php echo $nama; ?>"><br><br>

        <label>Telp</label><br>
        <input type="text" name="telp" value="<?php echo $telp; ?>"><br><br>

        <label>Alamat</label><br>
        <input type="text" name="alamat" value="<?php echo $alamat; ?>"><br><br>

        <input type="submit" value="Simpan">
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
