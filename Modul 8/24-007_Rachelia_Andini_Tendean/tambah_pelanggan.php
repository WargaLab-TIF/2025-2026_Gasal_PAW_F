<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

$errors = []; 
$pesan = "";
$nama = $telp = $alamat = $jenis_kelamin = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST["nama"] ?? ""));
    $telp = mysqli_real_escape_string($koneksi, trim($_POST["telp"] ?? ""));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST["alamat"] ?? ""));
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST["jenis_kelamin"] ?? "");

    if (empty($nama) || empty($telp) || empty($alamat) || empty($jenis_kelamin)) {
        $errors[] = "Semua field wajib diisi.";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Nomor Telepon hanya boleh angka.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) 
                  VALUES ('$nama', '$jenis_kelamin', '$telp', '$alamat')";
        
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data pelanggan berhasil ditambahkan!";
            $nama = $telp = $alamat = $jenis_kelamin = ""; // Reset form
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 300px; padding: 6px; }
        .btn-simpan { background: #28a745; color: white; padding: 8px 15px; border-radius: 4px; border: none; margin-top: 10px; cursor: pointer; }
        .btn-batal { background: #dc3545; color: white; padding: 8px 15px; border-radius: 4px; border: none; margin-left: 10px; cursor: pointer; }
        .error { color: red; margin: 10px 0; }
        .pesan { color: green; margin: 10px 0; }
        h3 { color: #8dadddff; }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div style="padding: 20px;">
        <h3>Tambah Data Pelanggan</h3>

        <?php if (!empty($errors)): ?>
            <div class="error"><ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
        <?php elseif ($pesan): ?>
            <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <table>
                <tr><td><label>Nama</label></td><td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required></td></tr>
                <tr><td><label>Jenis Kelamin</label></td>
                    <td>
                        <select name="jenis_kelamin" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" <?= $jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr><td><label>Telp</label></td><td><input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>" required></td></tr>
                <tr><td><label>Alamat</label></td><td><input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>" required></td></tr>
                <tr><td></td><td>
                    <button class="btn-simpan" type="submit" name="submit">Simpan</button>
                    <button class="btn-batal" type="button" onclick="window.location.href='master.php';">Batal</button>
                </td></tr>
            </table>
        </form>
    </div>
</body>
</html>