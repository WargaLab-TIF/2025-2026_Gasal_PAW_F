<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

$errors = []; 
$pesan = "";
$username = "";
$nama = "";
$password = "";
$alamat = "";
$hp = "";
$level = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($koneksi, trim($_POST["username"] ?? ""));
    $nama = mysqli_real_escape_string($koneksi, trim($_POST["nama"] ?? ""));
    $password = mysqli_real_escape_string($koneksi, $_POST["password"] ?? ""); // Password diambil sebelum di-hash
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST["alamat"] ?? ""));
    $hp = mysqli_real_escape_string($koneksi, trim($_POST["hp"] ?? ""));
    $level = mysqli_real_escape_string($koneksi, $_POST["level"] ?? "");

    if ($username === "") {
        $errors[] = "Username tidak boleh kosong.";
    }

    $cek_user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        $errors[] = "Username '$username' sudah digunakan.";
    }

    if ($password === "") {
        $errors[] = "Password tidak boleh kosong.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter.";
    }

    if ($nama === "") {
        $errors[] = "Nama tidak boleh kosong.";
    }
    
    if ($hp === "") {
        $errors[] = "Nomor HP tidak boleh kosong.";
    } elseif (!preg_match("/^[0-9]+$/", $hp)) {
        $errors[] = "Nomor HP hanya boleh angka.";
    }

    if ($level === "" || !in_array($level, ['1', '2'])) {
        $errors[] = "Level harus dipilih (Owner atau Kasir).";
    }

    if (empty($errors)) {
        $hashed_password = ($password);
        
        $query = "INSERT INTO user (username, password, nama, alamat, hp, level) 
                  VALUES ('$username', '$hashed_password', '$nama', '$alamat', '$hp', '$level')";
        
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data user berhasil ditambahkan!";
            $username = $nama = $password = $alamat = $hp = $level = ""; 
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
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
        <h3>Tambah Data User</h3>

        <?php if (!empty($errors)): ?>
            <div class="error"><ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
        <?php elseif ($pesan): ?>
            <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <table>
                <tr>
                    <td><label>Username</label></td>
                    <td><input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td><label>Nama </label></td>
                    <td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required></td>
                </tr>
                <tr>
                    <td><label>Nomor HP</label></td>
                    <td><input type="text" name="hp" value="<?= htmlspecialchars($hp) ?>" required></td>
                </tr>
                 <tr>
                    <td><label>Alamat</label></td>
                    <td><input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>"></td>
                </tr>
                <tr>
                    <td><label>Level</label></td>
                    <td>
                        <select name="level" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1" <?= $level == '1' ? 'selected' : '' ?>>1 - Owner</option>
                            <option value="2" <?= $level == '2' ? 'selected' : '' ?>>2 - Kasir</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button class="btn-simpan" type="submit" name="submit">Simpan</button>
                        <button class="btn-batal" type="button" onclick="window.location.href='master.php';">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>