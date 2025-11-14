<?php
require 'validate.inc';

$errors = [];

if (validateName($_POST, 'surname', $errors))
    echo "Data OK!<br>";
else
    echo "Data invalid!<br>";

if (!empty($errors)) {
    echo "<pre>";
    print_r($errors);
    echo "</pre>";
}
?>