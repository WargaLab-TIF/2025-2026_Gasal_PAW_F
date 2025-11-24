<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

$username = "";
$password = "";
$nama     = "";
$alamat   = "";
$telp     = "";
$jenis_user = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = trim($_POST['usernama'] ?? "");
    $password   = md5($_POST['password'] ?? "");
    $nama       = trim($_POST['nama'] ?? "");
    $alamat     = trim($_POST['alamat'] ?? "");
    $telp       = trim($_POST['telp'] ?? "");
    $jenis_user = intval($_POST['jenis_user'] ?? 0);

    $stmt = mysqli_prepare($conn, "INSERT INTO user (username, password, nama, alamat, hp, level) 
            VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssi", $username,$password,$nama,$alamat,$telp,$jenis_user);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: data_user.php");
            exit();
        } else {
            echo "Gagal menambahkan user: " . mysqli_error($conn);
        }
    } 
    else {
        echo "Gagal menyiapkan statement: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2>Tambah User</h2>

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="usernama" value="<?= htmlspecialchars($username) ?>">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password">
    </div>

    <div class="mb-3">
        <label>Nama User</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>">
    </div>

    <div class="mb-3">
        <label>Telp</label>
        <input type="number" name="telp" value="<?= htmlspecialchars($telp) ?>">
    </div>

    <div class="mb-3">
        <label>Jenis User</label>
        <select class="form-select" id="jenis_user" name="jenis_user" required>
            <option value="" disabled selected>--- Pilih Jenis User ---</option>
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
        </select>
    </div>

    <button type="submit">Tambah</button>
    <button type="button" onclick="window.location.href='/praktikum 8/24-114_Muhammad_Farrel_Fastha/owner/home.php'">Batal</button>
</form>

</body>
</html>
