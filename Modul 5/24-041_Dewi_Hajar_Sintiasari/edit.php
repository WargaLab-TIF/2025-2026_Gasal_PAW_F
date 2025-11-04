<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'store';

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$id = $_GET['id']; 
$sql = "SELECT * FROM supplier WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$errors = [];
$nama = $row['nama'];
$telp = $row['telp'];
$alamat = $row['alamat'];

if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (empty($_POST['nama']) || !preg_match("/^[a-zA-Z'\.\s]*$/", $_POST['nama'])) {
        $errors['nama'] = "Nama tidak boleh kosong, hanya boleh huruf";
    } else {
        $nama = $_POST['nama'];
    }

    if (empty($_POST['telp']) || !preg_match("/^[0-9]*$/", $_POST['telp'])) {
        $errors['telp'] = "Telp tidak boleh kosong, hanya boleh angka";
    } else {
        $telp = $_POST['telp']; 
    }

    $alamat = trim($_POST['alamat']);
    if (empty($alamat)) {
        $errors['alamat'] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match('/[A-Za-z]/', $alamat)) {
        $errors['alamat'] = "Alamat harus mengandung huruf.";
    } elseif (!preg_match('/[0-9]/', $alamat)) {
        $errors['alamat'] = "Alamat harus mengandung angka.";
    }

    if (empty($errors)) {
        $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: ". mysqli_error($conn);
        }
    }
    
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 60px auto;
            background-color: white;
            border: 1px solid #cdcdcdff;
            border-radius: 6px;
            padding: 25px 30px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #3bd8ffff;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        small {
            color: red;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            margin-right: 6px;
            text-decoration : none;
        }
        .btn-simpan {
            background-color: #28a745;
        }
        .btn-batal {
            background-color: #dc3545;
        }
        .btn-wrapper {
            text-align: left;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Master Supplier</h2>
        <form method="POST" action="">
            <div>
                <label>Nama</label>
                <input type="text" name="nama"  
                    value="<?php if (isset($_POST['nama'])) echo $_POST['nama']; ?>">
                <?php if (isset($errors['nama'])) echo '<small>'.$errors['nama'].'</small>'; ?>
            </div>

            <div>
                <label>Telp</label>
                <input type="text" name="telp" 
                    value="<?php if (isset($_POST['telp'])) echo $_POST['telp']; ?>">
                <?php if (isset($errors['telp'])) echo '<small>'.$errors['telp'].'</small>'; ?>
            </div>

            <div>
                <label>Alamat</label>
                <input type="text" name="alamat" 
                    value="<?php if (isset($_POST['alamat'])) echo $_POST['alamat']; ?>">
                <?php if (isset($errors['alamat'])) echo '<small>'.$errors['alamat'].'</small>'; ?>
            </div>

            <div class="btn-wrapper">
                <button type="submit" class="btn btn-simpan">Update</button>
                <a href="index.php" class="btn btn-batal">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>