<?php include "includes/config.php"; ?>

<?php
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass     = md5($_POST['password']);

    // PENCEGAHAN SQL INJECTION
    $username = mysqli_real_escape_string($conn, $username);

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = $data['level']; 

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <h2>Form Login</h2>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error)) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
    </div>

</body>
</html>