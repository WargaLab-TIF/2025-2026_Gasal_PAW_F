<?php
require 'validate_error.inc';

if (validateName($_POST, 'surname')) {
    echo "Data OK!";
} else {
    global $errors;
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>

