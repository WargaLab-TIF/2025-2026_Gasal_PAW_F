<?php
require 'validate.inc';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;

    if (!validateName($_POST, 'surname', $errors)) $isValid = false;
    if (!validateEmail($_POST, 'email', $errors)) $isValid = false;

    if ($isValid) {
        echo "<h3>Form submitted successfully with no errors.</h3>";
    } else {
        echo "<h3>Terdapat kesalahan pada form:</h3>";
        echo "<ul>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul>";
        include 'form.inc';
    }
} else {
    include 'form.inc';
}
?>