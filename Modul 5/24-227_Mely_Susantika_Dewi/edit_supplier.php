<?php
$koneksi = mysqli_connect("localhost","root","","store") or die(mysqli_error($koneksi));

// ambil id dari URL
$id = $_GET['id'];

// ambil data supplier berdasarkan id
$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// simpan data lama ke variabel agar tampil di form
$nama = $row['nama'];
$telp = $row['telp'];
$alamat = $row['alamat'];
$error = "";

// jika tombol update ditekan
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // validasi data
    if (empty($nama)) {
        $error = "Nama tidak boleh kosong!";
    } elseif (empty($telp)) {
        $error = "Nomor telepon tidak boleh kosong!";
    } elseif (!is_numeric($telp)) {
        $error = "Nomor telepon hanya boleh angka!";
    } elseif (empty($alamat)) {
        $error = "Alamat tidak boleh kosong!";
    } else {
        // update data supplier ke database
        mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'") or die(mysqli_error($koneksi));

        // kembali ke halaman data supplier
        header("Location: data_supplier.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        input { margin: 5px 0; padding: 8px; width: 300px; }
        button, a { padding: 8px 15px; text-decoration: none; border: none; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; }
        a { background-color: #ccc; color: black; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Edit Data Supplier</h2>

<?php if ($error): ?>
<p class="error"><?= $error; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= $nama; ?>"><br>

    <label>Telepon:</label><br>
    <input type="text" name="telp" value="<?= $telp; ?>"><br>

    <label>Alamat:</label><br>
    <input type="text" name="alamat" value="<?= $alamat; ?>"><br>

    <button type="submit" name="update">Simpan</button>
    <a href="data_supplier.php">Batal</a>
</form>

</body>
</html>
