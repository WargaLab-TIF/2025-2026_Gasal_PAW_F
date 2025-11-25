<?php
include '../session/cek_owner.php';
include '../koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$q = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$d = mysqli_fetch_assoc($q);

if (!$d) {
    echo "<script>alert('Data supplier tidak ditemukan!'); window.location='supplier_index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $telp   = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    mysqli_query($koneksi,
        "UPDATE supplier SET 
            nama='$nama',
            telp='$telp',
            alamat='$alamat'
        WHERE id='$id'"
    );

    header("Location: supplier_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f5f5f5;
            font-family: Arial;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0274bd; 
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #0274bd;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #015a99;
        }
    </style>
</head>
<body>

<?php include '../template/navbar.php'; ?>

<div class="container">
    <h2>Edit Supplier</h2>

    <form method="POST">

        Nama Supplier:<br>
        <input type="text" name="nama" value="<?= htmlspecialchars($d['nama']) ?>" required><br>

        No Telepon:<br>
        <input type="text" name="telp" value="<?= htmlspecialchars($d['telp']) ?>"><br>

        Alamat:<br>
        <textarea name="alamat"><?= htmlspecialchars($d['alamat']) ?></textarea><br>

        <button type="submit">Update</button>

    </form>
</div>

</body>
</html>