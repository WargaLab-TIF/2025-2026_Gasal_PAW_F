<?php
require 'validate_error.inc';
$errors = [];
$surname = $_POST['surname'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (validateName($_POST, 'surname')) {
        echo "<p style='color:green;'>Form submitted successfully with no errors</p>";
    } else {
        global $errors;
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        include 'form.inc'; // tampilkan form lagi jika error
    }
} else {
    include 'form.inc'; // tampilkan form awal
}
?>
