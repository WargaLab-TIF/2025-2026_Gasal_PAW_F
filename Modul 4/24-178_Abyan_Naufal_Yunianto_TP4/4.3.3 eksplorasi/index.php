<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age   = trim($_POST['age']);
    $date  = trim($_POST['date']);

    $errors = [];

    // Validasi name (regex)
    if ($name == "") {
        $errors[] = "Nama wajib diisi.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $name)) {
        $errors[] = "Nama hanya boleh huruf alfabet.";
    }

    // Validasi email (filter)
    if ($email == "") {
        $errors[] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }

    // Validasi umur (type testing)
    if ($age == "") {
        $errors[] = "Umur wajib diisi.";
    } elseif (!is_numeric($age)) {
        $errors[] = "Umur harus berupa angka.";
    }

    // Validasi tanggal (checkdate)
    if ($date == "") {
        $errors[] = "Tanggal wajib diisi.";
    } elseif (strlen($date) == 10 && $date[4] == '-' && $date[7] == '-') {
        $year  = (int)substr($date, 0, 4);
        $month = (int)substr($date, 5, 2);
        $day   = (int)substr($date, 8, 2);

        if (!checkdate($month, $day, $year)) {
            $errors[] = "Tanggal tidak valid.";
        }
    } else {
        $errors[] = "Format tanggal harus YYYY-MM-DD.";
    }

    // Hasil
    if (empty($errors)) {
        echo "<p style='color:green;'>Form submitted successfully with no errors!</p>";
    } else {
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    }
}
?>

<form method="POST" action="">
    Nama: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Umur: <input type="text" name="age"><br><br>
    Tanggal (YYYY-MM-DD): <input type="text" name="date"><br><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>
