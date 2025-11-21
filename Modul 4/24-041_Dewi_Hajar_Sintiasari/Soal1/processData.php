<?php

// require 'validate.inc';
// if (validateName($_POST, 'surname')) {
//     echo 'Data OK!';
// } else {
//     echo 'Data invalid!';
// }

require 'validate.inc';
$errors = []; 

if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
} else {
    echo 'Data invalid! <br>';
    foreach ($errors as $error) {
        echo $error . '<br>';
}
}

?>