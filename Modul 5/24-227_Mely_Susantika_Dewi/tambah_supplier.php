<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost","root","","store") or die(mysqli_error($koneksi));

$error = "";

// Cek jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Validasi
    if ($nama == "" || $telp == "" || $alamat == "") {
        $error = "Semua data harus diisi!";
    } else {
        // Simpan ke database
        mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama','$telp','$alamat')");

        // Redirect ke data_supplier.php
        header("Location: data_supplier.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        input { padding: 8px; width: 300px; margin-bottom: 10px; }
        button, a { padding: 8px 12px; border: none; border-radius: 4px; text-decoration: none; }
        button { background-color: #4CAF50; color: white; }
        a { background-color: #ccc; color: black; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Tambah Data Supplier</h2>

<?php if ($error) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama"><br>
    <label>Telepon:</label><br>
    <input type="text" name="telp"><br>
    <label>Alamat:</label><br>
    <input type="text" name="alamat"><br>
    <button type="submit" name="simpan">Simpan</button>
    <a href="data_supplier.php">Batal</a>
</form>

</body>
</html>
