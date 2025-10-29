<?php
require 'validate2.inc';

$surname = "";
$email = "";
$password = "";
$errors = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $surname = trim($_POST["surname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($surname)) {
        $errors["surname"] = "Field 'surname' belum diisi.";
    } elseif (!validateSurname($surname)) {
        $errors["surname"] = "Field 'surname' hanya boleh berisi huruf alfabet dan spasi.";
    }

    if (empty($email)) {
        $errors["email"] = "Field 'email' belum diisi.";
    } elseif (!validateEmail($email)) {
        $errors["email"] = "Format email harus mengandung '@'.";
    }

    if (empty($password)) {
        $errors["password"] = "Field 'password' belum diisi.";
    } elseif (!validatePassword($password)) {
        $errors["password"] = "Password harus minimal 6 digit.";
    }

    if (empty($errors)) {
        $message = "Form berhasil dikirim tanpa error!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Validasi</title>
</head>
<body>

<?php
if (!empty($errors) || $_SERVER["REQUEST_METHOD"] != "POST") {
    include 'form2.inc';
} else {
    echo "<p style='color:green'>$message</p>";
    echo "<p>Surname: " . htmlspecialchars($surname) . "</p>";
    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    echo "<p>Password: " . htmlspecialchars($password) ."</p>";
}
?>
</body>
</html>