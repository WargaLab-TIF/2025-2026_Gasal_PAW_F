<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$q  = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
if (!$q || mysqli_num_rows($q)==0) {
    header("Location: index.php");
    exit;
}
$data = mysqli_fetch_assoc($q);

$nama = $data['nama'];
$telp = $data['telp'];
$alamat = $data['alamat'];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    if ($nama == "" || !preg_match("/^[A-Za-z. ]+$/", $nama)) {
        $errors[] = "Nama tidak boleh kosong dan hanya boleh huruf serta titik.";
    }
    if ($telp == "" || !preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Telp tidak boleh kosong dan hanya boleh angka.";
    }
    if ($alamat == "") {
        $errors[] = "Alamat tidak boleh kosong.";
    }

    if (empty($errors)) {
        $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Gagal update: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Data Supplier</title>
</head>
<body>
    <h2>Edit Data Supplier</h2>

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

        <input type="submit" value="Update">
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
