<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = ($_POST['password']); 

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = ($user['level'] == '1' ? "Owner" : "Kasir");
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color:red;'>Username atau Password salah!</p>";
    }
}
?>