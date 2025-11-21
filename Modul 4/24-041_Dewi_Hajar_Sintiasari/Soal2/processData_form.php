<?php
$errors = [];
$surname = $email = $password = $alamat = $gender = "";
$hobi = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $alamat = $_POST["alamat"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $hobi = isset($_POST["hobi"]) ? $_POST["hobi"] : [];

    // Jika kosong
    $allEmpty = ($surname === "" && $email === "" && $password === "" && $alamat === "" && $gender === "" && empty($hobi));
    if ($allEmpty) {
        echo "";
        exit;
    }

    // Username
    if (empty($_POST['surname'])) {
        $errors['surname'] = "Username tidak boleh kosong.";
    } else {
        $pattern = "/^[a-zA-Z'-]+$/";
        if (!preg_match($pattern, $_POST['surname'])) {
            $errors['surname'] = "Username harus berupa alfabet.";
        }
    }

    // Email
    if (empty($_POST['email'])) {
        $errors['email'] = "Email harus diisi.";
    } else {
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($pattern, $_POST['email'])) {
            $errors['email'] = "Invalid email format.";
        }
    }

    // Password
    if (empty($_POST['password'])) {
        $errors['password'] = "Password harus diisi.";
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $errors['password'] = "Password harus minimal 8 karakter.";
        }
    }

    // Alamat
    if (empty($_POST['alamat'])) {
        $errors['alamat'] = "Alamat harus diisi.";
    }

    // Gender
    if (!isset($_POST['gender'])) {
        $errors['gender'] = "Pilih salah satu gender!";
    }

    // Hobi
    if (empty($_POST['hobi'])) {
        $errors['hobi'] = "Pilih setidaknya satu hobi!";
    }

    if (empty($errors)) {
        echo "Form submitted successfully with no errors!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Form</title>
</head>
<body>

<?php
require 'form.inc'; 

echo "<br>";

if (!empty($errors)) {
    echo "<div style='color:red;'>";
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo "</div>";
} 
?>

</body>
</html>