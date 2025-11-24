<?php
session_start();
// jika sudah login, cegah akses ke login.php
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body style="background:#f2f2f2; font-family:Arial, sans-serif;">

    <div style="
        width:400px;
        background:#F0DEFF;
        padding:30px;
        margin:80px auto;
        text-align:center;
        border-radius:10px;
        box-shadow:0px 0px 10px rgba(0,0,0,0.1);
    ">
        <h2 style="color:#B5B9FF; margin-bottom:20px;">Login Admin</h2>

        <form action="proses_login.php" method="POST">
            
            <input type="text" name="username" placeholder="Username"
            style="width:90%; padding:12px; margin:8px 0; border:1px solid #ccc; border-radius:5px;">

            <input type="password" name="password" placeholder="Password"
            style="width:90%; padding:12px; margin:8px 0; border:1px solid #ccc; border-radius:5px;">

            <input type="submit" value="Login"
            style="width:95%; padding:12px; background:#C5A3FF; border:none; color:#F0DEFF; border-radius:5px; font-size:16px; cursor:pointer; margin-top:10px;">
        </form>

    </div>

</body>
</html>
