<?php
session_start(); 

if (isset($_SESSION['login'])) {
    if ($_SESSION['level'] == 1) {
        header("Location: owner/home.php");
    } else {
        header("Location: kasir/home.php");
    }
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/loginStyle.css">
    <title>Login</title>
</head>
<body>

<div class="login-container">

    <h2>Login</h2>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form action="proses-login.php" method="POST">

        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Login">

    </form>

</div>

</body>
</html>
