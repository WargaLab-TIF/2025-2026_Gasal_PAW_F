<?php

include "koneksi.php";

$nama = "";
$telp = "";
$alamat = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    if (empty($nama)) {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $nama)) {
        $errors[] = "Nama hanya boleh berisi huruf dan spasi.";
    }

    if (empty($telp)) {
        $errors[] = "Telp tidak boleh kosong.";
    } elseif (!ctype_digit($telp)) {
        $errors[] = "Telp hanya boleh berisi angka.";
    }

    if (empty($alamat)) {
        $errors[] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d\s]+$/', $alamat)) {
        $errors[] = "Alamat harus alfanumerik (minimal 1 huruf dan 1 angka, boleh ada spasi).";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
            exit(); 
        } else {
            $errors[] = "Terjadi kesalahan saat menyimpan data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #2a6592;
            margin-bottom: 15px;
        }
        form {
            max-width: 500px;
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
         }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #84b02c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
         }
        a.btn-batal {
            margin-left: 15px;
            text-decoration: none;
            background-color: #444;
            color: white;
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 14px;
        }
        a.btn-batal:hover {
            background-color: #222;
        }
        .error-list {
            color: red;
            margin-bottom: 15px;
            background-color: #fdd;
            padding: 10px;
            border: 1px solid red;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>Tambah Data Supplier</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="update.php" method="POST">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($nama); ?>"> <br>
        <label for="telp">Telp</label>
        <input type="text" name="telp" id="telp" value="<?php echo htmlspecialchars($telp); ?>"> <br>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="<?php echo htmlspecialchars($alamat); ?>"> <br>
        <input type="submit" value="Simpan">
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
