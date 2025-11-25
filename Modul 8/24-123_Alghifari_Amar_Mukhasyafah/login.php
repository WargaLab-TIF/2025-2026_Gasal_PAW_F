<?php
session_start();
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="auth.php" method="post">
        Masukkan Username Anda : <input type="text" placeholder="masukkan username anda : " name="username" required><br>
        Masukkan Password Anda : <input type="text" placeholder="masukkan password anda : " name="password" required><br>
        <button name="submit" type="submit">LOGIN</button>
    </form>
</body>
</html>