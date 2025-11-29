<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

$errors = []; 
$pesan = "";
$id = $_GET['id'] ?? null; 

$data_lama_q = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
if (mysqli_num_rows($data_lama_q) == 0) {
    $errors[] = "Data supplier tidak ditemukan.";
}
$data_lama = mysqli_fetch_assoc($data_lama_q);
$nama = $data_lama['nama'] ?? '';
$telp = $data_lama['telp'] ?? '';
$alamat = $data_lama['alamat'] ?? '';
$email = $data_lama['email'] ?? '';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, trim($_POST["nama"] ?? ""));
    $telp = mysqli_real_escape_string($koneksi, trim($_POST["telp"] ?? ""));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST["alamat"] ?? ""));
    $email = mysqli_real_escape_string($koneksi, trim($_POST["email"] ?? ""));

    if (empty($nama) || empty($telp) || empty($alamat) || empty($email)) {
        $errors[] = "Semua field wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }
    
    if (empty($errors)) {
        $query = "UPDATE supplier SET 
                  nama='$nama', 
                  telp='$telp', 
                  alamat='$alamat', 
                  email='$email'
                  WHERE id='$id'";
        
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data supplier berhasil diperbarui!";
            $data_lama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'"));
            $nama = $data_lama['nama'];
            $telp = $data_lama['telp'];
            $alamat = $data_lama['alamat'];
            $email = $data_lama['email'];
        } else {
            $errors[] = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
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
        <h3>Edit Data Supplier</h3>

        <?php if (!empty($errors)): ?>
            <div class="error"><ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
        <?php elseif ($pesan): ?>
            <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>"> 
            <table>
                <tr><td><label>Nama</label></td><td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required></td></tr>
                <tr><td><label>Telp</label></td><td><input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>" required></td></tr>
                <tr><td><label>Alamat</label></td><td><input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>" required></td></tr>
                <tr><td><label>Email</label></td><td><input type="text" name="email" value="<?= htmlspecialchars($email) ?>" required></td></tr>
                <tr><td></td><td>
                    <button class="btn-simpan" type="submit" name="submit" >Update</button>
                    <button class="btn-batal" type="button" onclick="window.location.href='master.php';">Batal</button>
                </td></tr>
            </table>
        </form>
    </div>
</body>
</html>