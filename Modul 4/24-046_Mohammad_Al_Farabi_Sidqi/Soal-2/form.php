<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data</title>
</head>
<?php
require 'validate.inc';
if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['password'])) $password = $_POST['password'];
    $error = [];
    $email_err = $password_err = $surname_err = '';


    validateEmail($_POST, 'email', $email_err);

    validatePass($_POST, 'password', $password_err);


    if (validateName($_POST, 'surname', $error)) {
        echo 'Form submitted successfully with no errors';
        include 'form.inc';
    } else {
        foreach ($error as $msg) {
            echo $msg;
            $surname_err = $msg;
        }
        include 'form.inc';
    }
} else {
    include 'form.inc';
}


?>

</html>