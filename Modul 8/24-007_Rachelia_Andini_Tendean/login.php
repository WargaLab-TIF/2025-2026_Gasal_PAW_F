<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Filter XSS input (mencegah script)
    $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');

    // Cegah SQL Injection pakai Prepared Statement
    $stmt = $koneksi->prepare("SELECT id_user, username, password, nama, level FROM user WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah username ditemukan
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

       if ($password === $user['password']){ 
            // Set session aman
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['level'] = $user['level'];
            $_SESSION['user_id'] = $user['id_user'];

            header("Location: index.php");
            exit;

       }else {
            $error = "Username atau password salah";
        }
    } else {
        $error = "Username atau password salah";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f2f2f2; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            width: 300px; 
            background: white; 
            padding: 20px 25px;
            border: 1px solid #ccc; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 { 
            text-align: center; 
            color: #3f9bebff;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] { 
            width: 100%; 
            padding: 10px; 
            margin: 7px 0 15px 0; 
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        button { 
            width: 100%; 
            padding: 10px; 
            background: #3f9bebff; 
            color: white; 
            border: 0; 
            border-radius: 5px; 
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Admin</h2> 

        <?php if ($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" >
            <input type="password" name="password" placeholder="Password" >
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
