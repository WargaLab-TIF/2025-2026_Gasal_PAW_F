<?php
require 'validate.inc';

$errors = [];
$isSubmitted = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($isSubmitted) {
    $isValid = validateName($_POST, 'surname', $errors);

    if ($isValid && empty($errors)) {
        echo "<h3>Form submitted successfully with no errors.</h3>";
    } else {
        echo "<h3>Terjadi kesalahan pada input!</h3>";
        include 'form.inc';
    }
} else {
    include 'form.inc';
}
?>
