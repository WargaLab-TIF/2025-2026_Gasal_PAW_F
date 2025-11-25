<?php 
$koneksi = mysqli_connect("localhost", "root", "", "store");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    if ($nama == "" || $telp == "" || $alamat == "") {
        echo "Semua field harus diisi!<br>";
    } elseif (!ctype_alpha(str_replace(' ', '', $nama))) {
        echo "Nama hanya boleh huruf!<br>";
    } elseif (!ctype_digit($telp)) {
        echo "Telepon hanya boleh angka!<br>";
    } else {
        mysqli_query($koneksi, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
        header("Location: supplier.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
</head>
<style>
    .update{background-color: green;}
    .batal{background-color: red;}
</style>
<body>
    <h2>Edit Data Supplier</h2>
    <form method="POST">
        Nama: <input type="text" name="nama" value="<?= $row['nama']; ?>"><br><br>
        Telepon: <input type="text" name="telp" value="<?= $row['telp']; ?>"><br><br>
        Alamat: <input type="text" name="alamat" value="<?= $row['alamat']; ?>"><br><br>
        <input type="submit" name="update" value="Update" class="update">
        <input type="button" value="Batal" onclick="window.location='supplier.php'" class="batal">
    </form>
</body>
</html>
