<?php
require 'validate.inc';
$errors = array();

if (isset($_POST['submit'])) {
    if (!empty($_POST['surname'])) {
        if (validateName($_POST, 'surname', $errors)) {
            echo "<p>Form submitted successfully with no errors.</p>";
        } else {
            echo "<p>Terjadi kesalahan:</p>";
            foreach ($errors as $message) {
                echo "<p>$message</p>";
            }
            include 'form.inc'; 
        }
    } else {
        echo "<p>Form kosong, silakan isi!</p>";
        include 'form.inc'; 
    }
} else {
    include 'form.inc';
}
?>
