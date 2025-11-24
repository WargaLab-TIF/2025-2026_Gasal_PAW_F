<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

if (isset($_GET['id_user'])) {
    $id_user = intval($_GET['id_user']);

    $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);

    $result_query = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_query) > 0) {
        $result = mysqli_fetch_assoc($result_query);
    } else {
        echo "Data user tidak ditemukan!";
        exit;
    }
} 
else {
    echo "ID user tidak valid!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_user = intval($_POST['id_user']);

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat   = mysqli_real_escape_string($conn, $_POST['alamat']);
    $hp       = mysqli_real_escape_string($conn, $_POST['hp']);
    $level    = intval($_POST['level']);

    if ($password == "") {
        $password = $result['password'];
    } else {
        $password = md5($password); 
    }

    $update = "UPDATE user SET
                    username = '$username',
                    password = '$password',
                    nama     = '$nama',
                    alamat   = '$alamat',
                    hp       = '$hp',
                    level    = '$level'
               WHERE id_user = $id_user";

    if (mysqli_query($conn, $update)) {
        header("Location: data_user.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
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
        .btn-cancel {
            background: gray;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<form action="" method="POST">
    <h2>Edit User</h2>

    <input type="hidden" name="id_user" value="<?= $result['id_user']; ?>">

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($result['username']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password">
    </div>

    <div class="mb-3">
        <label>Nama User</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($result['nama']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($result['alamat']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Telp</label>
        <input type="number" name="hp" value="<?= htmlspecialchars($result['hp']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Jenis User</label>
        <select class="form-select" name="level" required>
            <option value="" disabled>--- Pilih Jenis User ---</option>
            <option value="1" <?= ($result['level'] == 1 ? 'selected' : '') ?>>Owner</option>
            <option value="2" <?= ($result['level'] == 2 ? 'selected' : '') ?>>Kasir</option>
        </select>
    </div>

    <button type="submit">Update</button>
    <button type="button" class="btn-cancel" onclick="window.location.href='home.php'">Batal</button>
</form>

</body>
</html>