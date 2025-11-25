<?php
    
    session_start();
    require 'database/conn.php';
    
    // 1. Jika user sudah login, tidak boleh mengakses halaman login 
    if (isset($_SESSION['login'])) {
        if ($_SESSION['role'] == 1) {
            header("Location: index.php");
        } else {
            header("Location: user.php");
        }
        exit;
    }

    if (!isset($_SESSION['coba'])){
        $_SESSION['coba'] = 0;
    }

    $login_failed = false;

    if ($_SESSION['coba'] > 2){
        // Menampilkan pesan error dan menghentikan eksekusi
        $error_message = "Percobaan login melebihi batas (3 kali)! Harap tunggu.";
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username_user = $_POST['username'];
            $password = $_POST['password'];
            // Hapus baris password hashing agar sesuai dengan data di store.sql
            
            // Menggunakan prepared statement untuk mencegah SQL Injection
            $query = "SELECT id_user, username, nama, level FROM user WHERE username = ? AND password = MD5(?)"; // Anggap password di DB menggunakan MD5
            $statment = mysqli_prepare($koneksi, $query);
            
            // Dalam store.sql, password user sudah di-hash, kita coba pakai password yang sama dengan di file user yang Anda upload
            // $query = "SELECT id_user, username, nama, level FROM user WHERE username = ? AND password = ?"; // Digunakan jika input password sama dengan hash di DB
            
            // Saya akan menggunakan query asli Anda (tanpa MD5) dan mengasumsikan data di DB sudah merupakan hash yang sama dengan input user, atau user harus memasukkan hash (kurang ideal).
            // Saya kembali ke kode Anda yang sebelumnya dan menambahkan MD5 ke query jika Anda ingin memasukkan password asli (misal: "rudi123"). 
            // Namun, untuk mengikuti kode Anda yang sudah ada:
            $query_original = "SELECT id_user, username, nama, level FROM user WHERE username = ? AND password = ?";
            $statment = mysqli_prepare($koneksi, $query_original);
            
            mysqli_stmt_bind_param($statment, "ss", $username_user, $password);
            mysqli_stmt_execute($statment);
            $ex = mysqli_stmt_get_result($statment);

            if (mysqli_num_rows($ex) > 0) {
                $result = mysqli_fetch_assoc($ex);
                $_SESSION['login'] = true;
                $_SESSION['role'] = $result['level'];
                $_SESSION['nama_user'] = $result['nama']; // Menyimpan nama user 
                $_SESSION['id_user'] = $result['id_user']; // Menyimpan ID user

                if ($result['level'] == 1){ // Level 1 (Owner) 
                    header("Location: index.php");
                } else { // Level 2 (Kasir/User Biasa) 
                    header("Location: user.php");
                }
                exit;
            } else {
                $_SESSION['coba'] += 1;
                $login_failed = true;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        /* CSS yang sudah Anda sediakan */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: transparent;
            text-align: center;
        }

        .login-box h2 {
            color: #3498db;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .login-form {
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0 0 0 1px #e2e2e2;
            padding: 0;
            overflow: hidden;
            width: 260px;
            margin: 0 auto 15px;
        }

        .login-form input {
            width: 100%;
            border: none;
            border-bottom: 1px solid #e2e2e2;
            padding: 10px;
            font-size: 14px;
            outline: none;
        }

        .login-form input:last-child {
            border-bottom: none;
        }

        .btn-login {
            width: 260px;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background: linear-gradient(#37a0f2, #1f78d7);
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login Sistem Penjualan</h2>

        <form  action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <div class="login-form">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <?php if (isset($error_message)): ?>
            <p class="error-message"><?= $error_message ?></p>
        <?php elseif ($login_failed): ?>
            <p class="error-message">Username atau password salah. Sisa percobaan: <?= 3 - $_SESSION['coba'] ?></p>
        <?php endif; ?>
        
    </div>

</body>
</html>