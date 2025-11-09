<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self Submission Form</title>
</head>
<body>
<?php
    require 'validate.inc';
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Jalankan semua validasi (tidak berhenti di satu field)
        validateName($_POST, 'username', $errors);
        validateEmail($_POST, 'email', $errors);
        validatePassword($_POST, 'password', $errors);

        // Kalau tidak ada error sama sekali
        if (empty($errors)) {
            echo "<h3>Form submitted successfully with no errors.</h3>";
        } else {
            echo "<h3>Terjadi kesalahan:</h3>";
            foreach ($errors as $field => $errorMsg) {
                echo "<p style='color:red;'>$errorMsg</p>";
            }
            include 'form.inc';
        }

    } else {
        include 'form.inc';
    }
?>
</body>
</html>
