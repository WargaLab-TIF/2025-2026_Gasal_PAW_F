<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="store";
$koneksi = mysqli_connect($servername, $username, $password, $db);

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'] ?? null;
$result = [];

if ($id) {
    $sql = "SELECT * FROM supplier WHERE id = $id";
    $query = mysqli_query($koneksi, $sql);
    $result = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            width: 100px;
            font-weight: bold;
        }
        .form-group input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            max-width: 200px;
        }
        .button-container {
            margin-left: 100px;
        }
        .simpan {
            background-color: green;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .simpan:hover {
            background-color: darkgreen;
        }
        .batal {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .batal:hover {
            background-color: darkred;
        }
    </style>
<body>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="telp">Telp</label>
            <input type="text" name="telp" id="telp" value="<?= $result['telp'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="alamat">Email</label>
            <input type="text" name="alamat" id="alamat" value="<?= $result['alamat'] ?? '' ?>">
        </div>
        <div class="button-container">
            <button type="submit" name="submit" class="simpan">Simpan</button>
            <form action="index.php" method="get" class="formBatal">
                <button class="batal" type="submit">batal</button>
            </form>
        </div>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $id) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
        header("location: index.php");
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>