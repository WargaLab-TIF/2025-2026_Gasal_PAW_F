<?php
session_start();
require 'koneksi.php';

// ------------ CEK SESSION LAMA ------------
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// ------------ PROSES LOGIN ------------
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
    body {
        margin: 0;
        padding: 0;
        background: #f1f1f1;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 350px;
        margin: 60px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    label {
        font-size: 14px;
        display: block;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #cbd5e0;
        background: #eef3ff;
        margin-bottom: 15px;
        font-size: 14px;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        background: #0A4D9B;
        color: white;
        font-weight: bold;
        font-size: 15px;
        border-radius: 6px;
        cursor: pointer;
    }

    button:hover {
        background: #0A4D9B;
    }

    .error {
        color: red;
        margin-bottom: 15px;
        text-align: center;
    }
</style>

</head>
<body>

<div class="container">

    <h2>Login User</h2>

    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="submit">LOGIN</button>
    </form>

</div>

</body>
</html>
