<?php
    session_start();
    require "conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $sql = "SELECT username, level FROM user
        WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row["level"] == "1") {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["level"] = "Admin";
                header("Location: index.php");
            } else {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["level"] = "user";
                header("Location: index.php");
        }
    } else {
    $error_message = "Username atau Password salah!";
}
mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Status Login</title>
    </head>
    <body>
        <?php
            if (isset($error_message)) {
                echo $error_message;
                echo "<p><a href='login.php'>Kembali</a></p>";
            } ?>
        </body>
    </html>