<?php
include "koneksi.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID User tidak ditemukan.");
}

$id_user = mysqli_real_escape_string($koneksi, $_GET['id']);
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; 
    $level    = mysqli_real_escape_string($koneksi, $_POST['level']);

    $sql_set = "username = '$username', level = '$level'";
    if (!empty($password)) {
        $hashed_password = md5($password); 
        $sql_set .= ", password = '$hashed_password'";
    }

    $sql_update = "UPDATE user SET {$sql_set} WHERE id = '$id_user'";

    if (mysqli_query($koneksi, $sql_update)) {
        header("Location: data_user.php?status=sukses_edit");
        exit();
    } else {
        $pesan = "<p style='color:red;'>Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

$sql_user = "SELECT id_user, username, level FROM user WHERE id_user = '$id_user'";
$result_user = mysqli_query($koneksi, $sql_user);

if (mysqli_num_rows($result_user) == 0) {
    die("Data user tidak ditemukan.");
}
$data_user = mysqli_fetch_assoc($result_user);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User: <?php echo htmlspecialchars($data_user['username']); ?></title>
</head>
<body style="font-family: Arial, sans-serif;">

<table  width="100%" bgcolor="black" cellpadding="10" cellspacing="0">
    <tr>
        <td width="50%">
            <font color="white">
            <a href="data_user.php" style="color:white; text-decoration:none; "><b>&lt; Kembali</b></a>
            </font>
        </td>
    </tr>
</table>
<h1 align="center">EDIT DATA USER</h1>
<?php echo $pesan; ?>
<form action="edit_user.php?id=<?php echo $id_user; ?>" method="POST" style="width: 50%; margin: 20px auto; text-align: left;">

    <table width="80%" cellpadding="5"> 
        <tr>
            <td width="30%"><label for="username">Username</label></td>
            <td width="70%"><input type="text" id="username" name="username" value="<?php echo htmlspecialchars($data_user['username']); ?>" required style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="password">Password (Kosongkan jika tidak diubah)</label></td>
            <td><input type="password" id="password" name="password" placeholder="Isi untuk mengubah password" style="width: 60%;"></td>
        </tr>
        <tr>
            <td><label for="level">Level/Role</label></td>
            <td>
                <select id="level" name="level" required style="width: 62%;">
                    <?php 
                        $level_saat_ini = htmlspecialchars($data_user['level']);
                        $level_options = ['admin', 'kasir', 'gudang'];
                    ?>
                    <option value="">-- Pilih Level --</option>
                    <?php foreach ($level_options as $option): ?>
                        <option value="<?php echo $option; ?>" <?php echo ($level_saat_ini == $option) ? 'selected' : ''; ?>>
                            <?php echo ucfirst($option); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 15px;">
                <button type="submit" style="padding: 10px 20px; background-color: limegreen; color: white; border: none; cursor: pointer; border-radius: 4px;"><b>Simpan Perubahan</b></button>
                <a href="data_user.php" style="margin-left: 10px; padding: 9px 20px; text-decoration: none; color: white; background-color: red; border-radius: 4px;"><b>Batal</b></a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>