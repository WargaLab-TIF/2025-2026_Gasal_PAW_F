<?php
$conn = new mysqli("localhost", "root", "", "tp5");

$id = $_GET['id']; 

$errors = [];
$nama = $telp = $alamat = "";

//mengambil data
$sql = "SELECT * FROM supplier WHERE no=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "Data tidak ditemukan!";
    exit;
}
$row    = mysqli_fetch_assoc($result);
$nama   = $row['nama'];
$telp   = $row['telp'];
$alamat = $row['alamat'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    if (empty($_POST['nama']) || !preg_match("/^[A-Za-z\s]+$/", $_POST['nama'])) {
        $errors['nama'] = "Nama tidak boleh kosong, hanya boleh huruf";
    } else {
        $nama = $_POST['nama'];
    }

    if (empty($_POST['telp']) || !preg_match("/^[0-9]+$/", $_POST['telp'])) {
        $errors['telp'] = "Telp tidak boleh kosong, hanya boleh angka";
    } else {
        $telp = $_POST['telp']; 
    }

    if (empty($_POST['alamat']) || !preg_match("/^(?=.*[0-9])(?=.*[A-Za-z])[A-Za-z0-9\s]+$/", $_POST['alamat'])) {
        $errors['alamat'] = "Alamat tidak boleh kosong, harus alfanumerik (min. 1 huruf & 1 angka)";
    } else {
        $alamat = $_POST['alamat'];
    }

    if (empty($errors)) {
        $sql = "UPDATE supplier 
                SET nama='$nama', telp='$telp', alamat='$alamat' 
                WHERE no=$id";
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
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 25px 30px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
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
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #b52a35;
        }
        .btn-wrapper {
            text-align: center;
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
                <input type="text" name="nama" required value="<?php echo $nama; ?>">
                <?php if (isset($errors['nama'])) echo '<small>'.$errors['nama'].'</small>'; ?>
            </div>

            <div>
                <label>Telp</label>
                <input type="text" name="telp" required value="<?php echo $telp; ?>">
                <?php if (isset($errors['telp'])) echo '<small>'.$errors['telp'].'</small>'; ?>
            </div>

            <div>
                <label>Alamat</label>
                <input type="text" name="alamat" required value="<?php echo $alamat; ?>">
                <?php if (isset($errors['alamat'])) echo '<small>'.$errors['alamat'].'</small>'; ?>
            </div>

            <div class="btn-wrapper">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
