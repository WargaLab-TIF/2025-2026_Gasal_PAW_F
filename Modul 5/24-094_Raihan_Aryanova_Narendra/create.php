<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "store";
$koneksi = mysqli_connect($servername,$username,$password, $database);
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $telp = trim($_POST["telp"]);
    $alamat = trim($_POST["alamat"]);

    if (empty($nama)) $errors[] = "Nama tidak boleh kosong.";
    elseif (!preg_match("/^[a-zA-Z\s].+$/", $nama)) $errors[] = "Nama hanya boleh huruf titik dan spasi.";

    if (empty($telp)) $errors[] = "Nomor telepon tidak boleh kosong.";
    elseif (!preg_match("/^[0-9]+$/", $telp)) $errors[] = "Nomor telepon hanya boleh angka.";

    if (empty($alamat)) $errors[] = "Alamat tidak boleh kosong.";

    if (empty($errors)) {
        $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Gagal menambah data.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f6ff;
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
        font-size: 24px;
        border-bottom: 3px solid #4a7bff;
        padding-bottom: 6px;
    }

    form {
        background: #fff;
        padding: 20px 25px;
        width: 350px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
    }

    label {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 2px;
    }

    input[type="text"],
    textarea {
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
        box-sizing: border-box;
        outline: none;
        transition: .2s;
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: #4a7bff;
        box-shadow: 0 0 5px rgba(74,123,255,0.4);
    }

    input[type="submit"] {
        background: #4a7bff;
        color: white;
        border: none;
        padding: 10px;
        font-size: 14px;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 5px;
        transition: 0.2s;
    }

    input[type="submit"]:hover {
        background: #345ce8;
    }

    ul {
        background: #ffe2e2;
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 15px;
        width: 350px;
        color: #c0392b;
        font-size: 14px;
        list-style: square;
    }

    a {
        margin-top: 15px;
        text-decoration: none;
        color: #4a7bff;
        font-size: 14px;
        transition: .2s;
    }

    a:hover {
        color: #345ce8;
        text-decoration: underline;
    }
</style>

</head>
<body>
        <h2>Tambah Supplier</h2>

        <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $err): ?>
                <?= htmlspecialchars($err) ?><br>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <form method="POST">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $_POST['nama'] ?? '' ?>">
            
            <label>Telepon</label>
            <input type="text" name="telp" value="<?= $_POST['telp'] ?? '' ?>">
            
            <label>Alamat</label>
            <textarea name="alamat" rows="3"><?= $_POST['alamat'] ?? '' ?></textarea>
            
            <input type="submit" value="Simpan">
        </form>

        <a href="index.php">← Kembali</a>
</body>
</html>
