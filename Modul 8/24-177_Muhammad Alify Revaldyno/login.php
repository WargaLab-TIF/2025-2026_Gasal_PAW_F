<?php
session_start();


// Jika user sudah login, diarahkan ke index
if (isset($_SESSION['user'])) {
header("Location: index.php");
exit;
}


// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'];
$password = $_POST['password'];


$users = [
'owner' => ['password' => 'owner123', 'level' => 1, 'name' => 'Owner Toko'],
'kasir' => ['password' => 'kasir123', 'level' => 2, 'name' => 'Kasir Toko']
];


if (isset($users[$username]) && $password === $users[$username]['password']) {


// Set SESSION
$_SESSION['user'] = [
'username' => $username,
'name' => $users[$username]['name'],
'level' => $users[$username]['level']
];


header("Location: index.php");
exit;


} else {
$error = "Username atau Password salah";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<h2>Login</h2>


<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>


<form method="POST">
Username:<br>
<input type="text" name="username" required><br>
Password:<br>
<input type="password" name="password" required><br><br>
<button type="submit">Login</button>
</form>
</body>
</html>