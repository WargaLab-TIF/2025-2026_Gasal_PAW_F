<?php
    session_start();
    if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
    require "../conn.php";
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $level = $_POST['level'];
        $query = "INSERT INTO user (username, password, nama, level) VALUES ('$username', '$password', '$nama', '$level')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('User ditambahkan!');window.location='datamaster.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tambah User</title>
        <style>
            body {
                font-family:sans-serif;
                background:#f4f4f4;
                padding:20px;
            }
            .container {
                background:white;
                max-width:500px;
                margin:auto;
                padding:20px;
                border-radius:5px;
                box-shadow:0 0 10px rgba(0,0,0,0.1);
            }
            input, select  {
                width:100%;
                padding:10px;
                margin:10px 0;
                border:1px solid #ddd;
                border-radius:4px;
                box-sizing:border-box;
            }
            button  {
                width:100%;
                padding:10px;
                background:#27ae60;
                color:white;
                border:none;
                border-radius:4px;
                cursor:pointer;
            }
            .back-btn  {
                background:#555;
                margin-top:10px;
                display:block;
                text-align:center;
                text-decoration:none;
                padding:10px;
                border-radius:4px;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Tambah User</h2>
            <form method="POST">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>
                <label>Username</label>
                <input type="text" name="username" required>
                <label>Password</label>
                <input type="password" name="password" required>
                <label>Level</label>
                <select name="level">
                    <option value="Admin">Admin</option>
                    <option value="Kasir">Kasir</option>
                </select>
                <button type="submit" name="submit">Simpan</button>
                <a href="datamaster.php" class="back-btn">Kembali</a>
            </form>
        </div>
    </body>
</html>