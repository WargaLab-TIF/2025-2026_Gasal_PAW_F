<?php
session_start();

include 'koneksi.php';

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if ($_SESSION['role'] == 1) {
        header('Location: admin.php');
    } else {
        header('Location: user.php');
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $p = md5($p);
    $sql = "SELECT * FROM user WHERE username= ? AND password=?";

    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $u, $p);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result)) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['role'] = $user['level'];
        $_SESSION['nama'] = $user['nama'] ?? $user['username']; 

        if ($user['level'] == 1) {
            header('Location: admin.php');
        } else {
            header('Location: user.php');
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<style>
    h2 {
        text-align: center;
    }

    form {
        max-width: 300px;
        margin: 0 auto;
    }

    input[type="text"],
    input[type="password"],
    button {
        width: 100%;
        box-sizing: border-box;
    }
</style>

<body>
    <h2>Login Admin</h2>

    <form method="POST">
        Username:<br>
        <input type="text" name="username"><br><br>

        Password:<br>
        <input type="password" name="password"><br><br>

        <button name="login">Login</button>
    </form>


</body>

</html>