<?php
require 'validate.php';

$valueEmail = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (validateName($_POST, 'surname') && validateEmail($_POST, 'email')) {
        echo 'Form submitted successfully with no errors';
    } else {
        echo 'Data invalid! <br>';
        echo $error[0];
        $value = $_POST['surname'];
        $valueEmail = $_POST['email'];
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
    <?php include "form.inc";?>
</body>
</html>