<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>
<style>
body { background:#f2f2f2; font-family:Arial; }
.login { width:350px; margin:90px auto; padding:30px; background:#fff; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.2); }
input,button { width:100%; padding:10px; margin-top:10px; }
button { background:#2377ff; border:none; color:white; cursor:pointer; }
</style>
</head>
<body>

<div class="login">
<h2 align="center">Login</h2>

<form action="proses_login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

</div>
</body>
</html>
