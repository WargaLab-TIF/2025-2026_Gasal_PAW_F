<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($servername, $username, $password,$database);

$nama = "";
$telp = "";
$alamat = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    $chek_telp = false;
    $chek_nama = false;
    $chek_alamat = false;

    if (preg_match("/^[a-zA-Z]+$/", $telp) !== false and !empty($_POST["telp"])) {
        // echo "Nomor Telepon valid <br>";
        $chek_telp = true;
    } else {
        echo "Nomor Telepon Tidak valid <br>";
    }

    $temp_nama = str_replace(' ', '', $_POST['nama']);
    if (preg_match("/^[a-zA-Z]+$/", $temp_nama) and !empty($_POST["nama"])) {
        // echo "Nama valid <br>";
        $chek_nama = true;
    } else {
        echo "Nama tidak valid <br>";
    }

    if ($_POST["alamat"] == "") {
        echo "Alamat tidak boleh kosong <br>";
    } elseif (!preg_match("/[a-zA-Z]/", $alamat)) {
        echo "Alamat harus mengandung huruf <br>";
    } elseif (!preg_match("/[0-9]/", $alamat)) {
        echo "Alamat harus mengandung angka <br>";
    } else {
        $chek_alamat = true;
    }


    if ($chek_alamat == true && $chek_telp == true && $chek_nama == true) {

        $sql = "INSERT INTO supplier(nama,telp,alamat) VALUES('$nama','$telp','$alamat')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
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
    <style>
    .tombol_merah{
        background-color:red;
        padding:5px;
        padding-right:10px;
        padding-left:10px;
        border-radius:3px;
        border:none;
        margin-top:10px;
    }
    .tombol_hijau{
        background-color:green;
        padding:5px;
        padding-right:10px;
        padding-left:10px;
        border-radius:3px;
        border:none;
        margin-top:10px;
        color:white;
    }
    a{
        color:white;
    }
    </style>
</head>
<body>
    <form action="create.php" method="post">
        <label for="">Nama: </label><br>
        <input type="text" name="nama" value="<?php echo $nama ?>"> <br>
            
        <label for="">Telp:</label><br>
        <input type="number" name="telp" value="<?php echo $telp ?>"> <br>
        
        <label for="">Alamat:</label><br>
        <input type="text" name="alamat" value="<?php echo $alamat ?>"> <br>
        
        <button type="submit" class="tombol_hijau">Simpan</button>
        <button class="tombol_merah"><a href="index.php" style="text-decoration:none;">Batal</a></button>
    </form>
</body>
</html>
