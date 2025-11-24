<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

$nama = "";
$alamat = "";
$telp = "";
$jenis_kelamin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST['nama_pelanggan'] ?? "");
    $alamat         = trim($_POST['alamat'] ?? "");
    $telp        = trim($_POST['telepon'] ?? "");
    $jenis_kelamin  = $_POST['jenis_kelamin'] ?? "";

    $stmt = mysqli_prepare($conn, 
        "INSERT INTO pelanggan (nama_pelanggan, alamat, telepon, jenis_kelamin) 
         VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "ssss",
        $nama, $alamat, $telp, $jenis_kelamin
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: pelanggan.php");
        exit();
    } else {
        echo "Gagal menambahkan pelanggan: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Pelanggan</title>

    <style>
        body {
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
            width: 380px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        label { margin-top: 8px; font-weight: bold; }
        input, textarea, select {
            width: 100%; padding: 8px; margin-top: 4px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            padding: 10px;
            border-radius: 6px;
            border: none;
            width: 100%;
            margin-top: 12px;
            color: white;
            cursor: pointer;
        }
        .btn-save { background: blue; }
        .btn-cancel { background: gray; }
    </style>
</head>
<body>

<form method="POST">
    <h2>Tambah Pelanggan</h2>

    <div class="mb-3">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Telepon</label>
        <input type="text" name="telp" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn-save">Tambah Pelanggan</button>
    <button type="button" class="btn-cancel" onclick="window.location.href='pelanggan.php'">Batal</button>

</form>

</body>
</html>
