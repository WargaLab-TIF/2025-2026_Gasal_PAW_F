<?php
require 'validate.inc';

$errors = [];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valid = true;

    if (!validateName($_POST, 'surname', $errors)) $valid = false;
    if (!validateEmail($_POST, 'email', $errors)) $valid = false;
    if (!validateAge($_POST, 'age', $errors)) $valid = false;
    if (!validateBirthdate($_POST, 'birthdate', $errors)) $valid = false;

    if ($valid) {
        $message = 'form submitted successfully with no errors';
    } else {
        $message = 'ERROR silakan periksa kembali input Anda.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?php echo $message; ?></h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] != 'POST' || !empty($errors)) {
        include 'form.inc';
    }
    ?>
</body>
</html>