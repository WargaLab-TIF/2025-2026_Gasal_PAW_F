<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
<h2>LOGIN</h2>

<form method="POST" action="aksi.php?aksi=login">
    Username:<br>
    <input type="text" name="u"><br><br>

    Password:<br>
    <input type="password" name="p"><br><br>

    <button>Masuk</button>
</form>

</body>
</html>
