<?php
session_start();

// Validasi login jika sudah login tidak boleh lagi login
if (isset($_SESSION['level'])) {
    header("Location: index.php");
    exit();
}

include "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek Username dan Password
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Penjualan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #e9e9e9;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 350px;
            background: white;
            margin: 80px auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0056A6;
        }
        input {
            width: 94%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 15px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #0056A6;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #00498f;
        }
        .error {
            background: #ffdddd;
            padding: 10px;
            border-left: 5px solid red;
            margin-bottom: 10px;
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-container">
    <h2>Login Sistem Penjualan</h2>

    <?php if ($error != "") { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit" name="login">LOGIN</button>
    </form>
</div>

</body>
</html>
