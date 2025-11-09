<?php
require 'validate.inc';
$errors = [];
if (validateName($_POST, 'username', $errors)) {
    echo 'Data OK!';
} else {
    echo 'Data invalid!<br>';
    foreach ($errors as $field => $message) {
        echo "$field: $message<br>";
    }
}
?>
