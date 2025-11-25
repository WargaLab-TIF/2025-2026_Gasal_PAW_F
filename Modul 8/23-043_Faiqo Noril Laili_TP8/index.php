<?php
include "koneksi.php";
if (isset($_GET['pesan'])) {
if ($_GET['pesan'] == "gagal") {
echo "<div class='alert'>Username dan Password Salah !</div>";
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-username {
            margin: 0;
        }

        .login-text {
            font-size: 2rem;
            font-weight: 800;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .login-register-text {
            font-size: 14px;
            color: #666;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <form action="login_prosses.php" method="POST" class="loginusername">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum punya akun? <a href="create.php">Register</a></p>
        </form>
    </div>
</body>

</html>