<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['nama'])) {
    if ($_SESSION['role'] == 1) {
        header("Location: admin.php");
        exit;
    } else {
        header("Location: kasir.php");
        exit;
    }
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_user = $_POST['username'];
    $password = md5($_POST['password']);
    $username_user = trim($_POST['username']);
    $password_input = trim($_POST['password']);

    if (strlen($username_user) > 20 || strlen($password_input) > 20) {
        $error = "Input terlalu panjang!";
    } else {
        $password = md5($password_input);
    }


    $query = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username_user, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['role'] = $user['level'];
        $_SESSION['nama'] = $user['nama'];

        if ($user['level'] == 1) {
            header("Location: admin.php");
        } else {
            header("Location: kasir.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 320px;
            text-align: center;
        }
        h2 {
            color: #2980b9;
            font-weight: 400;
            margin-bottom: 10px;
            font-size: 28px;
            text-align:left;
        }
        form {

        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 0;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 14px;
            color: #666;
            margin-bottom: -1px;
        }

        input[type="text"] {
            border-radius: 4px;
        }
        input[type="password"] {
            border-radius: 4px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
        }
        button:hover {
            background-color: #2980b9;
        }
        ::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login Admin</h2> <form method="POST">
            <?php if($error): ?>
                <p style="color:red; text-align:left;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required> <input type="password" name="password" placeholder="Password" required> <button type="submit" name="login">Login</button> </form>
    </div>

</body>
</html>