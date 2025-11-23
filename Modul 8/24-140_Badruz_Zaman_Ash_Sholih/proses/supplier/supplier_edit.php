<?php 
    $conn = mysqli_connect("Localhost", "root", "", "penjualan");

    $nama = "";
    $telp = "";
    $alamat = "";
    $errors = [];

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM supplier WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        if(empty($nama)) {
            $errors['nama'] = "Nama tidak boleh kosong";
        }elseif(!preg_match("/^[a-zA-Z\s]*$/", $nama)) {
            $errors['nama'] = "Nama hanya boleh berisi huruf";
        }

        if (empty($telp)) {
            $errors['telp'] = "Telp tidak boleh kosong";
        } elseif (!ctype_digit($telp)) {
            $errors['telp'] = "Telp hanya boleh berisi angka.";
        }

        if (empty($alamat)) {
            $errors['alamat'] = "Alamat tidak boleh kosong";
        }

        if (empty($errors)) {
            $sql = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = $id"; 

            if (mysqli_query($conn, $sql)) {
                header("Location: ../../data-master/data_supplier.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <style>
        body {
            font-family: verdana;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"] {
            width: 400px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: #d9534f;
            margin-top: 3px;
        }

        button[type="submit"]{
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            background-color: #5cb85c;
        }

        .btn-batal {
            display: inline-block;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
            background-color: #d9534f;
        }
        
        a {
            text-decoration: none;
            color: white;
        }

    </style>
</head>
<body>
    <h2>Edit Data Master Supplier</h2>

    <form action="" method="POST">
        <label for="">Nama : </label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>"> <br>
        <?php if (!empty($errors['nama'])): ?>
                <div class="error"><?php echo $errors['nama']; ?></div>
        <?php endif; ?>

        <label for="">Telp : </label>
        <input type="text" name="telp" value="<?php echo htmlspecialchars($telp); ?>"> <br>
        <?php if (!empty($errors['telp'])): ?>
                <div class="error"><?php echo $errors['telp']; ?></div>
        <?php endif; ?>

        <label for="">Alamat : </label>
        <input type="text" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>"> <br>
        <?php if (!empty($errors['alamat'])): ?>
                <div class="error"><?php echo $errors['alamat']; ?></div>
        <?php endif; ?>

        <input type="hidden" name="id" value="<?= $result['id']; ?>">

        <button type="submit">Update</button> 
        <button class="btn-batal"><a href="../../data-master/data_supplier.php">Batal</a></button>
    </form>
    
</body>
</html>