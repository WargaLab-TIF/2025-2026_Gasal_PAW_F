<?php
include "koneksi.php";

$errors = []; 
$pesan = "";
$nama = "";
$telp = "";
$alamat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nama = trim($_POST["nama"] ?? "");
    $telp = trim($_POST["telp"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");

    // Validasi
    if ($nama === "") {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $errors[] = "Nama hanya boleh huruf dan spasi.";
    }

    if ($telp === "") {
        $errors[] = "Telp tidak boleh kosong.";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Telp hanya boleh angka.";
    }

    if ($alamat === "") {
        $errors[] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match("/[a-zA-Z]/", $alamat) || !preg_match("/[0-9]/", $alamat)) {
        $errors[] = "Alamat harus alfanumerik (minimal 1 huruf dan 1 angka).";
    }

    // Jika tidak ada error maka akan simpan ke database
    if (empty($errors)) {
        mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')");
        $pesan = "Data berhasil ditambahkan!";
        $nama = $telp = $alamat = ""; // reset form
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input { width: 300px; padding: 6px; }
        .btn-simpan { background: #28a745; color: white; padding: 8px 15px; border-radius: 4px; border: none; margin-top: 10px; cursor: pointer; }
        .btn-batal { background: #dc3545; color: white; padding: 8px 15px; border-radius: 4px; border: none; margin-left: 10px; cursor: pointer; }
        .error { color: red; margin: 10px 0; }
        .pesan { color: green; margin: 10px 0; }
        h3 { color: #8dadddff; }
    </style>
</head>
<body>
    <h3>Tambah Data Supplier</h3>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($pesan): ?>
        <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <table>
            <tr>
                <td><label>Nama</label></td>
                <td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>"></td>
            </tr>
            <tr>
                <td><label>Telp</label></td>
                <td><input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>"></td>
            </tr>
            <tr>
                <td><label>Alamat</label></td>
                <td><input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn-simpan" type="submit" name="submit">Simpan</button>
                    <button class="btn-batal" type="button" onclick="window.location.href='index.php';">Batal</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
