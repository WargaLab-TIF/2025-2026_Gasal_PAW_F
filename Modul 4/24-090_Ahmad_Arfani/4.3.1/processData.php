<?php
// langkah 2
// require 'validate.inc';

// if (validateName($_POST, 'surname'))
//     echo 'Data OK!';
// else
//     echo 'Data invalid!';


// langkah 5
require 'validate.inc';
$errors = [];

if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
} else {
    echo 'Data invalid!<br><br>';

    foreach ($errors as $field => $error) {
        echo "<p><b>Error di $field:</b> $error</p>";
    }
}
?>