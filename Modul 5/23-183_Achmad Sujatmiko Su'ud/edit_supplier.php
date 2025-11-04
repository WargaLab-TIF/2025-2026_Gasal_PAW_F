<?php
include "koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

$error = "";
$nama = $data['nama'];
$telp = $data['telp'];
$alamat = $data['alamat'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $telp = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    if (empty($nama) || !preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error = "Nama hanya boleh huruf dan tidak boleh kosong!";
    } elseif (empty($telp) || !preg_match("/^[0-9]+$/", $telp)) {
        $error = "Telepon hanya boleh angka dan tidak boleh kosong!";
    } elseif (empty($alamat) || !preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/", $alamat)) {
        $error = "Alamat harus berisi huruf dan angka!";
    } else {
        mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
        header("Location: supplier.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
    <style>
        body { font-family: Arial; background: #f1f3f6; }
        form {
            width: 320px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
        label { font-weight: bold; }
        input[type=text] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .btn-update {
            background: #007bff;
        }
        .btn-update:hover { background: #0069d9; }
        .btn-batal {
            background: #6c757d;
            text-decoration: none;
        }
        .btn-batal:hover { background: #5a6268; }
        p { color: red; text-align: center; }
    </style>
</head>
<body>

<form method="POST">
    <h2 align="center">Edit Supplier</h2>
    <?php if ($error != "") echo "<p>$error</p>"; ?>
    <label>Nama:</label>
    <input type="text" name="nama" value="<?php echo $nama; ?>">

    <label>Telepon:</label>
    <input type="text" name="telp" value="<?php echo $telp; ?>">

    <label>Alamat:</label>
    <input type="text" name="alamat" value="<?php echo $alamat; ?>">

    <input type="submit" value="Update" class="btn btn-update">
    <a href="supplier.php" class="btn btn-batal">Batal</a>
</form>

</body>
</html>
