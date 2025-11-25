<?php

    include "../../koneksi.php";


    if (isset($_GET['id_user'])) {
        $id = $_GET['id_user'];
        $sql = "SELECT * FROM user WHERE id_user = $id";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_user = $_POST['id_user'];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = hash("sha256", $password);
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $hp = $_POST["hp"];
        $level = $_POST["level"];

        $sql = "UPDATE user SET username = '$username', password = '$password', nama = '$nama', alamat = '$alamat', hp = '$hp', level = '$level' WHERE id_user = $id_user";

        if (mysqli_query($conn, $sql)) {
            header("location: user.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/inputStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <label for="username">Username: </label><br>
            <input type="text" name="username" id="username" value="<?= $result['username'] ?>"><br><br>

            <label for="password">Password: </label><br>
            <input type="password" name="password" id="password"><br><br>

            <label for="nama">Nama User: </label><br>
            <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?>"><br><br>

            <label for="alamat">Alamat: </label><br>
            <textarea name="alamat" id="alamat"><?= $result['alamat'] ?></textarea><br><br>

            <label for="hp">No HP: </label><br>
            <input type="number" name="hp" id="hp" value="<?= $result['hp'] ?>"><br><br>

            <label for="level">Level</label>
            <select name="level" id="level">
                <option>Pilih Level</option>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
            </select><br><br>
            
            <input type="hidden" name="id_user" value="<?= $result['id_user'] ?>">

            <button type="submit" name="submit" id="submit">Simpan</button>
            <button type="button" onclick="window.location.href='user.php'">Batal</button>
        </form>
    </div>
</body>
</html>