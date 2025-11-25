<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

$errors = []; 
$pesan = "";
$id_user = $_GET['id'] ?? null; 

$data_lama_q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
if (mysqli_num_rows($data_lama_q) == 0) {
    $errors[] = "Data user tidak ditemukan.";
} else {
    $data_lama = mysqli_fetch_assoc($data_lama_q);
    $username = $data_lama['username'] ?? '';
    $nama = $data_lama['nama'] ?? '';
    $alamat = $data_lama['alamat'] ?? '';
    $hp = $data_lama['hp'] ?? '';
    $level = $data_lama['level'] ?? '';
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id_user = mysqli_real_escape_string($koneksi, $_POST["id_user"]); // ID dari hidden field
    $username = mysqli_real_escape_string($koneksi, trim($_POST["username"] ?? ""));
    $password_new = mysqli_real_escape_string($koneksi, $_POST["password"] ?? ""); 
    $nama = mysqli_real_escape_string($koneksi, trim($_POST["nama"] ?? ""));
    $alamat = mysqli_real_escape_string($koneksi, trim($_POST["alamat"] ?? ""));
    $hp = mysqli_real_escape_string($koneksi, trim($_POST["hp"] ?? ""));
    $level = mysqli_real_escape_string($koneksi, $_POST["level"] ?? "");

    if ($username === "" || $nama === "" || $hp === "" || $level === "") {
        $errors[] = "Nama, Username, HP, dan Level tidak boleh kosong.";
    }
    if (!empty($password_new) && strlen($password_new) < 6) {
        $errors[] = "Password baru minimal 6 karakter.";
    }
    
    $cek_user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username='$username' AND id_user != '$id_user'");
    if (mysqli_num_rows($cek_user) > 0) {
        $errors[] = "Username '$username' sudah digunakan oleh user lain.";
    }

    if (empty($errors)) {
        $password_update_field = "";
        if (!empty($password_new)) {
            $password_update_field = ", password='" . md5($password_new) . "'";
        }
        
        $query = "UPDATE user SET 
                  username='$username',
                  nama='$nama',
                  alamat='$alamat',
                  hp='$hp',
                  level='$level'
                  $password_update_field 
                  WHERE id_user='$id_user'";
        
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data user berhasil diperbarui!";
            $data_lama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'"));
            $username = $data_lama['username'];
            $nama = $data_lama['nama'];
            $alamat = $data_lama['alamat'];
            $hp = $data_lama['hp'];
            $level = $data_lama['level'];
        } else {
            $errors[] = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
        <h3>Edit Data User</h3>

        <?php if (!empty($errors)): ?>
            <div class="error"><ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
        <?php elseif ($pesan): ?>
            <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <table>
                <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user) ?>">
                <tr>
                    <td><label>Username</label></td>
                    <td><input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required></td>
                </tr>
                <tr>
                    <td><label>Password (Kosongkan jika tidak diubah)</label></td>
                    <td><input type="password" name="password"></td>
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
                        <button class="btn-simpan" type="submit" name="submit">Update</button>
                        <button class="btn-batal" type="button" onclick="window.location.href='master.php';">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>