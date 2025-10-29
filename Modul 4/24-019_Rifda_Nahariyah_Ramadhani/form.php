<?php
require 'validate.inc'; 

$surname = "";
$error = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["surname"]) && trim($_POST["surname"]) !== "") {

        $surname = $_POST["surname"];

        if (validateName($_POST, 'surname')) {
            $message = "Form submitted successfully with no errors.";
        } else {
            $error = "Input surname hanya boleh huruf alfabet (A-Z, a-z).";
        }
    } else {
        $error = "Form belum diisi. Silakan isi terlebih dahulu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Self-Submission</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($error)) {
            echo "<p style='color:red;'>$error</p>";
            include 'form.inc';
        } elseif (!empty($message)) {
            echo "<p style='color:green;'>$message</p>";
        }
    } else {
        include 'form2.inc';
    }
    ?>
</body>
</html>

