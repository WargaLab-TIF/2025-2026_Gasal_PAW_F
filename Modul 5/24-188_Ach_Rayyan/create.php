<?php
    
    require 'koneksi.php';
    require 'validate.inc';
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        validateName($_POST, 'nama', $errors);
        validateTelepon($_POST, 'telp', $errors);
        validateAlamat($_POST, 'alamat', $errors);

        if (empty($errors)) {
            $nama = $_POST["nama"];
            $telp = $_POST["telp"];
            $alamat = $_POST["alamat"];

            $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
            if (mysqli_query($conn, $sql)) {
                header("location: tabel.php");
            }
        } else {
            echo "<h3>Terjadi kesalahan:</h3>";
            foreach ($errors as $field => $errorMsg) {
                echo "<p style='color:red;'>$errorMsg</p>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Tambah Data Master Supplier Baru</h2>

    <form action="" method="POST">
      <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">
      </div>

      <div>
        <label for="telp">Telepon</label>
        <input type="text" name="telp" id="telp" value="<?php echo isset($_POST['telp']) ? htmlspecialchars($_POST['telp']) : ''; ?>">
      </div>

      <div>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="<?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?>">
      </div>

      <div class="button-group">
        <button type="submit" class="btn btn-green">Simpan</button>
        <a href="tabel.php" class="btn btn-red">Batal</a>
      </div>
    </form>
  </div>
</body>

</html>