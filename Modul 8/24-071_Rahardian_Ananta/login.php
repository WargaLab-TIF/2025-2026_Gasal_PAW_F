<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Admin</title>
        <style>
            *  {
                box-sizing: border-box;
            }
            body  {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f0f2f5;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .login-container  {
                background-color: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 400px;
            }
            .login-container h2  {
                text-align: center;
                color: #333;
                margin-bottom: 30px;
            }
            input  {
                width: 100%;
                padding: 12px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                transition: border-color 0.3s;
            }
            input:focus  {
                border-color: #007bff;
                outline: none;
            }
            button  {
                width: 100%;
                padding: 12px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
                transition: background 0.3s;
            }
            .btn-login  {
                background-color: #007bff;
                color: white;
                margin-bottom: 10px;
            }
            .btn-login:hover  {
                background-color: #0056b3;
            }
            .btn-register  {
                background-color: #28a745;
                color: white;
            }
            .btn-register:hover  {
                background-color: #218838;
            }
            .divider  {
                text-align: center;
                margin: 15px 0;
                color: #777;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h2>Login Admin</h2>
            <form action="proses_login.php" method="post">
                <input type="text" name="username" placeholder="Username" required autocomplete="off">
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn-login">Masuk</button>
            </form>
            <div class="divider">atau</div>
            <a href="register.php" style="text-decoration: none;">
                <button class="btn-register">Daftar Akun Baru</button>
            </a>
        </div>
    </body>
</html>