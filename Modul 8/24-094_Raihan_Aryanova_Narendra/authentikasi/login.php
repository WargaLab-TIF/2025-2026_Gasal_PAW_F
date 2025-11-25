<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:../home.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Penjualan</title>
    <style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

/* BODY */
body {
    background: #1b1f3b; /* biru tua */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* CONTAINER */
.login-container {
    width: 330px;
    background: #ffffff; /* putih */
    padding: 25px;
    border-radius: 12px;
}

/* TITLE */
.login-container h3 {
    text-align: center;
    color: #1b1f3b;
    margin-bottom: 18px;
}

/* ALERT */
.alert {
    padding: 10px;
    margin-bottom: 12px;
    font-size: 14px;
    border-radius: 6px;
}

.alert-danger { background: #f7dede; color: #a40000; }
.alert-success { background: #e3f7e8; color: #137a2a; }
.alert-warning { background: #fff4d1; color: #9a7600; }

/* FORM GROUP */
.form-group {
    margin-bottom: 12px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #1b1f3b;
    font-size: 14px;
}

/* INPUT */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #cfcfcf;
    border-radius: 8px;
    font-size: 14px;
    background: #fafafa;
}

/* INPUT FOCUS */
input:focus {
    border-color: #7a3cff; /* ungu */
    outline: none;
}

/* BUTTON */
.btn-login {
    width: 100%;
    padding: 10px;
    background: #7a3cff; /* ungu */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
}

.btn-login:hover {
    background: #5c2bbf; /* ungu gelap */
}

    </style>
</head>
<body>

    <div class="login-container">
        <h3>Login User</h3>
        
        <?php 
        if(isset($_GET['pesan'])){
            $pesan = htmlspecialchars($_GET['pesan']); 
            if($pesan == "gagal"){
                echo "<div class='alert alert-danger'>Login gagal! Username dan Password salah.</div>";
            }else if($pesan == "logout"){
                echo "<div class='alert alert-success'>Anda telah berhasil logout.</div>";
            }else if($pesan == "belum_login"){
                echo "<div class='alert alert-warning'>Anda harus login untuk mengakses halaman yang diminta.</div>";
            }
        }
        ?>
        <form method="POST" action="login_process.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Masukkan username" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>