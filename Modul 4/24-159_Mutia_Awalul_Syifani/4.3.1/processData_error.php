<?php
require 'validate_error.inc'; 

$errors = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (validateName($_POST, 'surname', $errors)) {
        echo "<p'>Data OK!</p>";
    } else {
        echo "<p'>Data invalid!</p>";

        if (!empty($errors)) {
            echo "<ul style='color:red;'>";
            foreach ($errors as $field => $message) {
                echo "<li>$message</li>";
            }
            echo "</ul>";
        }
    }
}
?>
