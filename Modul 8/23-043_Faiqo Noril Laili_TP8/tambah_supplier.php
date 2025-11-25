<?php
$koneksi = mysqli_connect("localhost", "root", "", "store");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Validasi sederhana
    if ($nama == "" || $telp == "" || $alamat == "") {
        echo "Semua field harus diisi!<br>";
    } elseif (!ctype_alpha(str_replace(' ', '', $nama))) {
        echo "Nama hanya boleh huruf!<br>";
    } elseif (!ctype_digit($telp)) {
        echo "Telepon hanya boleh angka!<br>";
    } else {
        mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
        header("Location: supplier.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
</head>
<style>
    .simpan{ background-color: green;}
    .batal{ background-color: red;}
</style>
<body>
    <h2>Tambah Data Supplier</h2>
    <form method="POST">
        Nama: <input type="text" name="nama"><br><br>
        Telepon: <input type="text" name="telp"><br><br>
        Alamat: <input type="text" name="alamat"><br><br>
        <input type="submit" name="simpan" value="Simpan" class="simpan">
        <input type="button" value="Batal" onclick="window.location='supplier.php'" class="batal">
    </form>
</body>
</html>
