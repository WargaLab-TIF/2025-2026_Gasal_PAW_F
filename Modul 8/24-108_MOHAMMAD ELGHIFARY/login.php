<?php
session_start();
require_once "conn.php";
    
if(isset($_SESSION['login']) && $_SESSION['login'] === true ){
    header("Location: index.php");
    exit();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit'])){

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Akses ditolak: Token keamanan tidak valid (CSRF).");
    }

    if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 3) {
        $lockout_time = 600;
        $time_since_last = time() - $_SESSION['last_failed_time'];
        
        if ($time_since_last < $lockout_time) {
            $sisa_waktu = ceil(($lockout_time - $time_since_last) / 60);
            $error_msg = "Terlalu banyak percobaan gagal. Tunggu $sisa_waktu menit.";
        } else {
            $_SESSION['failed_attempts'] = 0;
        }
    }
    if (!isset($error_msg)) {
        $username_post = $_POST['username'];
        $password_post = $_POST['password'];
        $password_hashed = md5($password_post);
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username_post, $password_hashed);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user){
            $_SESSION['failed_attempts'] = 0;
            session_regenerate_id(true);

            $_SESSION['login']    = true;
            $_SESSION['user_id']  = $user['id_user']; 
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['level']    = $user['level'];
            
            header("Location: index.php"); 
            exit();
        } else {

            if (!isset($_SESSION['failed_attempts'])) {
                $_SESSION['failed_attempts'] = 0;
            }
            $_SESSION['failed_attempts']++;
            $_SESSION['last_failed_time'] = time();

            sleep(2);
            
            $error_msg = "Username atau Password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <link rel="stylesheet" href="./css/login.css">
    <style>
        .error-alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        
        <?php if(isset($error_msg)): ?>
            <div class="error-alert"><?= $error_msg ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>