<?php
    require 'validate.inc';

    $errors = [];

    if (validateName($_POST, 'username', $errors)) {
        echo 'Data OK! <br>';
    } else {  
        echo 'Data invalid! <br>';
        if (isset($errors['username'])) {
            echo "Error: " . $errors['username'] . "<br>";
        }
    }
?>