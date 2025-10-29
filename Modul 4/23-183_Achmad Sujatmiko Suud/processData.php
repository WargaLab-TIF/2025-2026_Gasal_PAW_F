<?php
require 'validate.inc'; // wajib ada baris ini

$errors = [];

if (validateName($_POST, 'surname', $errors)) {
    echo "<h3>Data OK!</h3>";
} else {
    echo "<h3>Data invalid!</h3>";
}

if (!empty($errors)) {
    echo "<ul>";
    foreach ($errors as $field => $msg) {
        echo "<li>$msg</li>";
    }
    echo "</ul>";
}
?>
