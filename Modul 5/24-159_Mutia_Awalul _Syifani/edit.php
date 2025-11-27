<?php
include "koneksi.php";

$result = null;
$nama = "";
$telp = "";
$alamat = "";
$errors = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM supplier WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    
    $nama = $result['nama'];
    $telp = $result['telp'];
    $alamat = $result['alamat'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = trim($_POST['nama']);
    $telp = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

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

        $sql = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
            exit();
        } else {
            $errors[] = "Gagal mengupdate data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Data Supplier</title>
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
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            background-color: #f5821f; 
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
        }
        input[type="submit"]:hover {
            background-color: #d26d00;
        }
        a.btn-batal {
            background-color: #444; 
            color: white;
            padding: 10px 20px;
            border-radius: 3px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }
        a.btn-batal:hover {
            background-color: #aa1212;
        }
        .error-list {
            background-color: #fdd;
            color: #900;
            padding: 10px;
            border: 1px solid #900;
            margin-bottom: 15px;
            border-radius: 4px;
            list-style-position: inside;
        }
    </style>
</head>
<body>
    <h2>Edit Data Supplier</h2>
    
    <?php if (!empty($errors)): ?>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($nama); ?>" autocomplete="off" />

        <label for="telp">Telp:</label>
        <input type="text" name="telp" id="telp" value="<?= htmlspecialchars($telp); ?>" autocomplete="off" />

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" value="<?= htmlspecialchars($alamat); ?>" autocomplete="off" />

        <input type="hidden" name="id" value="<?= htmlspecialchars($result['id']); ?>" />

        <input type="submit" value="Update" />
        <a href="index.php" class="btn-batal">Batal</a>
    </form>
</body>
</html>
