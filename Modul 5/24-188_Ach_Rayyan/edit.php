<?php
    require 'koneksi.php';
    require 'validate.inc';
    $errors = [];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM supplier WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        validateName($_POST, 'nama', $errors);
        validateTelepon($_POST, 'telp', $errors);
        validateAlamat($_POST, 'alamat', $errors);

        if (empty($errors)) {
            $id = $_POST['id'];
            $nama = $_POST["nama"];
            $telp = $_POST["telp"];
            $alamat = $_POST["alamat"];

            $sql = "UPDATE supplier SET nama = '$nama' , telp = '$telp' , alamat = '$alamat' WHERE id = $id";

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
    <h2>Edit Data Supplier</h2>

    <form action="" method="POST">
      <input type="hidden" name="id" value="<?= $result['id'] ?>">

      <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?>">
      </div>

      <div>
        <label for="telp">Telepon</label>
        <input type="text" name="telp" id="telp" value="<?= $result['telp'] ?>">
      </div>

      <div>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="<?= $result['alamat'] ?>">
      </div>

      <div class="button-group">
        <button type="submit" class="btn btn-green">Simpan</button>
        <a href="tabel.php" class="btn btn-red">Batal</a>
      </div>
    </form>
  </div>
</body>
</html>